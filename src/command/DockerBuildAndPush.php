<?php


namespace Flyingmana\Shasa\Command;

use Flyingmana\Shasa\Service\Kubernetes;
use Flyingmana\Shasa\Service\Shortcut;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DockerBuildAndPush extends Command
{

    protected static $defaultName = 'docker:build-push';

    protected function configure()
    {
        // ...
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {


        // before the build, the autoloading needs to be build, maybe a composer install is enough
        // start local container
        // docker stop my-running-app && docker rm my-running-app && docker run -d -p 80:80 --name my-running-app  flyingmana/shasa-php-ci:latest
        // stop local container
        // docker stop my-running-app && docker rm my-running-app

        Shortcut::runProcess(
            "docker build -t flyingmana/shasa-php-ci .",
            $output,
            __DIR__.'/../../php-ci'
        );

        Shortcut::runProcess(
            "flyingmana/shasa-php-ci",
            $output,
            __DIR__.'/../../php-ci'
        );

        return Command::SUCCESS;
    }
}
