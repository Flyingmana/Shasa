<?php


namespace Flyingmana\Shasa\Command;

use Flyingmana\Shasa\Service\Kubernetes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DesktopDashboardInit extends Command
{

    protected static $defaultName = 'desktop:dashboard:init';

    protected function configure()
    {
        // ...
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * to have the dashboard running you need to run
         */
        // https://github.com/kubernetes/dashboard
        // kubectl apply -f https://raw.githubusercontent.com/kubernetes/dashboard/v2.0.4/aio/deploy/recommended.yaml
        // dashboard available at http://localhost:8001/api/v1/namespaces/kubernetes-dashboard/services/https:kubernetes-dashboard:/proxy/


        $kubernetes = new Kubernetes();
        $kubernetes->initClient();
        $kubernetes->client->setNamespace('kubernetes-dashboard');

        $defaultTokens = $kubernetes->findSecrets("kubernetes-dashboard-token");


        $table = new Table($output);
        $table
            ->setHeaders(['metadata/name', 'creationTimestamp'])
        ;
        foreach ( $defaultTokens as $node) {

            $table->setRows([[
                $node->getMetadata("name"),
                $node->getMetadata("creationTimestamp"),
            ]]);
            $table->render();
            $output->writeln(
                'data.token'
            );        $output->writeln(
                base64_decode ($node->getJsonPath("data.token")->first())
            );
        }

        return Command::SUCCESS;
    }
}
