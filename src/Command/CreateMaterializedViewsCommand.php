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
        $finder = new Finder();
        $existantViews = array_merge(...$connection->executeQuery('SELECT matviewname FROM pg_matviews;')->fetchAllNumeric());
        foreach ($this->materializedViews as $materializedView) {

        }


        $io->success('All views are created.');

        return Command::SUCCESS;
    }
}
