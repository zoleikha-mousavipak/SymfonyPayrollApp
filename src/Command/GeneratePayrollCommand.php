<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\PayrollGenerator;
use PhpParser\Node\Stmt\TryCatch;

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

        Try {
            $this->payrollGenerator->generateCSV($filename);
            $output->writeln('Payroll CSV generated successfully.');
        } catch (\Exception $e) {
            $output->writeln('An error occurred: ' . $e->getMessage());
        }        

        return Command::SUCCESS;
    }
}
