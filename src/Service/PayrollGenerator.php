<?php

namespace App\Service;

/**
 * Generates payroll data and exports it to a CSV file.
 */
class PayrollGenerator
{
    private PayrollStrategyFactory $strategyFactory;

    /**
     * Constructs a new PayrollGenerator instance.
     *
     * @param PayrollStrategyFactory $strategyFactory The factory for creating payroll strategies
     */
    public function __construct(PayrollStrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }

    /**
     * Generates payroll data and exports it to a CSV file.
     *
     * @param string $filename The name of the CSV file to generate
     * @return void
     */
    public function generateCSV(string $filename)
    {
        $handle = fopen($filename, 'w');
        fputcsv($handle, ['Month', 'Salary Date', 'Bonus Date']);

        $currentDate = new \DateTime();

        for ($i = 0; $i < 12; $i++) {
            $monthlyStrategy = $this->strategyFactory->createMonthlyStrategy();
            $bonusStrategy = $this->strategyFactory->createBonusStrategy();

            $monthlyData = $monthlyStrategy->generatePayrollData($currentDate);
            $bonusData = $bonusStrategy->generatePayrollData($currentDate);

            fputcsv($handle, [
                $monthlyData['month'],
                $monthlyData['salary_date'],
                $bonusData['bonus_date']
            ]);

            // Move to the next month
            $currentDate->modify('first day of next month');
        }

        fclose($handle);
    }
}