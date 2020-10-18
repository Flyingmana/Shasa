<?php


namespace Flyingmana\Shasa\Command;

use Flyingmana\Shasa\Service\Kubernetes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TektonInit extends Command
{

    protected static $defaultName = 'tekton:init';

    protected function configure()
    {
        // ...
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // https://github.com/tektoncd
        // https://tekton.dev/
        // https://tekton.dev/docs/getting-started/
        // kubectl apply --filename https://storage.googleapis.com/tekton-releases/pipeline/latest/release.yaml
        // dashboard available at


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
