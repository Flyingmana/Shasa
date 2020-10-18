<?php


namespace Flyingmana\Shasa\Command;

use Flyingmana\Shasa\Service\Kubernetes;
use Flyingmana\Shasa\Service\Shortcut;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TektonApply extends Command
{

    protected static $defaultName = 'tekton:apply';

    protected function configure()
    {
        // ...
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $basePath = realpath(__DIR__.'/../../').'/';

        $output->writeln("<info>basepath: $basePath</info>");
        Shortcut::runProcess("kubectl apply -f {$basePath}tekton/tasks/", $output);
        Shortcut::runProcess("kubectl apply -f {$basePath}tekton/pipelines/", $output);


        return Command::SUCCESS;
    }
}
