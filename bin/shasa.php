#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->add(new \Flyingmana\Shasa\Command\DesktopDashboardInit());
$application->add(new \Flyingmana\Shasa\Command\Overview());
$application->add(new \Flyingmana\Shasa\Command\DockerBuildAndPush());
$application->add(new \Flyingmana\Shasa\Command\TektonInit());
$application->add(new \Flyingmana\Shasa\Command\TektonPodsShow());
$application->add(new \Flyingmana\Shasa\Command\TektonApply());

$application->run();

