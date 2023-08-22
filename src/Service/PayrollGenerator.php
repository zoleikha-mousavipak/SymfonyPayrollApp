<?php

namespace App\Service;

class PayrollGenerator
{
    private PayrollStrategyFactory $strategyFactory;

    public function __construct(PayrollStrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }

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