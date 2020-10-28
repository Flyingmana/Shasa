<?php



namespace Flyingmana\Shasa\Service;


use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Shortcut
{
    public static function runProcess(string $command, OutputInterface $output, $cwd = null)
    {
        $process = new Process(explode(" ", $command), $cwd);

        try {
            $process->mustRun();

            $output->write($process->getOutput());
            if ($errorOutput = $process->getErrorOutput()) {

                $output->writeln("Command:<comment>{$command}</comment>");
                $output->write("<error>{$errorOutput}</error>");
            }
        } catch (ProcessFailedException $exception) {
            $output->write($exception->getMessage());
        }
    }

}
