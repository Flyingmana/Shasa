<?php


namespace Flyingmana\Shasa\Command;

use Flyingmana\Shasa\Service\Kubernetes;
use Flyingmana\Shasa\Service\Shortcut;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class TektonPodsShow extends Command
{

    protected static $defaultName = 'tekton:pods:show';

    protected function configure()
    {
        // ...
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        Shortcut::runProcess('kubectl get pods --namespace tekton-pipelines', $output);
        Shortcut::runProcess('kubectl get pv', $output);
        Shortcut::runProcess('kubectl get storageclasses', $output);

        return Command::SUCCESS;
    }
}
