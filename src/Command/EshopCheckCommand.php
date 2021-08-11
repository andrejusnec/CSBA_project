<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'eshop:check',
    description: 'Add a short description for your command',
)]
class EshopCheckCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setDescription('Random String')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('strong', null, InputOption::VALUE_NONE, 'Ask for a strong emotion')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');

        if ($yourName) {
            $io->note(sprintf('Hi %s', $yourName));
        }

        $strings = [ 'Happy', 'Sad', 'Anxious', 'Nervous', 'Frustrated', 'Joyful'];
        $str = $strings[array_rand($strings)];
        if ($input->getOption('strong')) {
            $str = strtoupper($str.'!!!');
        }

        $io->success($str);

        return Command::SUCCESS;
    }
}
