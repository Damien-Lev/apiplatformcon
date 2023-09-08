<?php

namespace App\Command;

use App\Tech\View\MaterializedViewDescriptionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:create-materialized-views',
    description: 'Create or update materialized view - Launch this command after the migrations',
)]
class CreateMaterializedViewsCommand extends Command
{
    public function __construct(#[TaggedIterator('app.materialized_view')]private iterable $materializedViews, private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $connection = $this->entityManager->getConnection();
        $existantViews = array_merge(...$connection->executeQuery('SELECT matviewname FROM pg_matviews;')->fetchAllNumeric());
        $projectViews = [];
        $viewsDescriptions = [];
        foreach ($this->materializedViews as $materializedView) {
            $reflexionClass = new \ReflectionClass($materializedView::class);
            $attributes = $reflexionClass->getAttributes();
            foreach ($attributes as $attribute) {
                if ($attribute->getName() === 'App\Tech\View\Attribute\MaterializedView') {
                    $tableName = $attribute->getArguments()['viewTableName'];
                    $projectViews[] = $tableName;
                    $viewsDescriptions[$tableName] = [
                        'query' => $attribute->getArguments()['query'],
                        'uniqueIndexField' => $attribute->getArguments()['uniqueIndexField'],
                    ];
                }
            }
        }
        $toDeleteViews = array_diff($existantViews, $projectViews);
        $toCreateViews = array_diff($projectViews, $existantViews);

        foreach ($toDeleteViews as $toDeleteView) {
            $connection->executeQuery(sprintf('DROP MATERIALIZED VIEW IF EXISTS %s', $toDeleteView));
            $io->info('DELETED MATERIALIZED VIEW '.$toDeleteView);
        }
        foreach ($toCreateViews as $toCreateView) {
            $createViewQuery = sprintf(
                'CREATE MATERIALIZED VIEW IF NOT EXISTS %s as %s;',
                $toCreateView,
                $viewsDescriptions[$toCreateView]['query']
            );
            $createIndexQuery = sprintf(
                ' CREATE UNIQUE INDEX %s ON %s (%s);',
                'uniq_'.$toCreateView,
                $toCreateView,
                $viewsDescriptions[$toCreateView]['uniqueIndexField']
            );
            $connection->executeQuery($createViewQuery);
            $connection->executeQuery($createIndexQuery);

            $io->info('CREATED MATERIALIZED VIEW '.$toCreateView);
        }
        foreach ($projectViews as $view) {
            $refreshDataQuery = sprintf(
                'REFRESH MATERIALIZED VIEW CONCURRENTLY %s WITH DATA;',
                $view
            );
            $connection->executeQuery($refreshDataQuery);
        }

        $io->success('All views are created.');

        return Command::SUCCESS;
    }
}
