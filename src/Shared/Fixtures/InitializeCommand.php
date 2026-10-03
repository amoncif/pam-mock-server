<?php

namespace App\Shared\Fixtures;

use App\Pam\Authentication\Entity\PamUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'pam:fixtures:initialize', description: 'Seed the local dataset only when the database is empty.')]
final class InitializeCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly LabFixtures $fixtures)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (0 === $this->em->getRepository(PamUser::class)->count([])) {
            $this->fixtures->load($this->em);
            $output->writeln('Local ACME fixtures loaded.');
        }

        return Command::SUCCESS;
    }
}
