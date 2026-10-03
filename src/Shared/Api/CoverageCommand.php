<?php

namespace App\Shared\Api;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'pam:api:coverage', description: 'Count implemented operations in the sourced endpoint manifest.')]
final class CoverageCommand extends Command
{
    public function __construct(private readonly EndpointManifest $manifest)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $groups = [];
        $done = 0;
        foreach ($this->manifest->all() as $e) {
            $tag = $e['tag'];
            $groups[$tag] ??= [0, 0, 0];
            ++$groups[$tag][1];
            if (in_array($e['status'], ['implemented', 'tested'], true)) {
                ++$groups[$tag][0];
                ++$done;
            } if ('partial' === $e['status']) {
                ++$groups[$tag][2];
            }
        }
        $rows = [];
        foreach ($groups as $tag => [$implemented, $total, $partial]) {
            $rows[] = [$tag, $implemented, $total, $partial, sprintf('%.1f%%', 100 * $implemented / $total)];
        }
        $total = count($this->manifest->all());
        $rows[] = ['Total', $done, $total, array_sum(array_column($groups, 2)), sprintf('%.1f%%', 100 * $done / $total)];
        $output->writeln('PAM API Coverage — known inventory, not a claim of vendor-wide completeness');
        (new Table($output))->setHeaders(['Domain', 'Implemented', 'Known', 'Partial', 'Coverage'])->setRows($rows)->render();

        return Command::SUCCESS;
    }
}
