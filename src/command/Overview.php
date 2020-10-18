<?php


namespace Flyingmana\Shasa\Command;

use Flyingmana\Shasa\Service\Kubernetes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Helper\Table;

class Overview extends Command
{

    protected static $defaultName = 'overview';

    protected function configure()
    {
        // ...
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $kubernetes = new Kubernetes();
        $kubernetes->initClient();

        $table = new Table($output);
        $table
            ->setHeaders(['metadata/name', 'selfLink', 'creationTimestamp'])
        ;
        foreach ( $kubernetes->getNodes() as $node) {

            $table->addRow([
                $node->getMetadata("name"),
                $node->getMetadata("selfLink"),
                $node->getMetadata("creationTimestamp"),
            ]);
        }
        $output->writeln("Nodes");
        $table->render();

        return Command::SUCCESS;


    }
}
