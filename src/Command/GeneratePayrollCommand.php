<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\PayrollGenerator;
use PhpParser\Node\Stmt\TryCatch;

class GeneratePayrollCommand extends Command
{
    private $payrollGenerator;
    private $logger;

    public function __construct(PayrollGenerator $payrollGenerator, LoggerInterface $logger)
    {
        parent::__construct();
        $this->payrollGenerator = $payrollGenerator;
        $this->logger = $logger;
    }

    protected function configure(): void
    {
        $this->setName('payroll:generate')
            ->setDescription('Generate payroll CSV')
            ->addArgument('filename', InputArgument::REQUIRED, 'Output CSV filename');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('filename');

        Try {
            $this->payrollGenerator->generateCSV($filename);
            $output->writeln('Payroll CSV generated successfully.');
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            $output->writeln('An error occurred: ' . $e->getMessage());
        }        

        return Command::SUCCESS;
    }
}
