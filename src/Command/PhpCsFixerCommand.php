<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PhpCsFixerCommand.
 *
 * @package App\Command
 */
class PhpCsFixerCommand extends Command {
    /**
     * @var string
     */
    private $projectDir;

    /**
     * PhpCsFixerCommand constructor.
     *
     * @param string $projectDir
     */
    public function __construct(string $projectDir) {
        parent::__construct('fix:code');
        $this->projectDir = $projectDir;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void {
        $this->setDescription('Modifie le code avec les conventions définies dans bin/.php_cs.dist.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): void {
        $fixOutput = [];
        chdir($this->projectDir.'/bin');
        exec('php php-cs-fixer fix --allow-risky=yes', $fixOutput);
        $output->write($fixOutput, true);
    }
}
