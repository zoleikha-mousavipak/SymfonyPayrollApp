<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\PayrollGenerator;

class GeneratePayrollCommand extends Command
{
    private PayrollGenerator $payrollGenerator;

    public function __construct(PayrollGenerator $payrollGenerator)
    {
        $this->payrollGenerator = $payrollGenerator;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('payroll:generate')
            ->setDescription('Generate payroll CSV')
            ->addArgument('filename', InputArgument::REQUIRED, 'Output CSV filename');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');
        $this->payrollGenerator->generateCSV($filename);

        $output->writeln('Payroll CSV generated successfully.');

        return Command::SUCCESS;
    }
}
