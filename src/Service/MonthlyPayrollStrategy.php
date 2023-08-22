<?php

namespace App\Service;

class MonthlyPayrollStrategy implements PayrollStrategyInterface
{
    public function generatePayrollData(\DateTime $date): array
    {
        // generate monthly payroll data
        $salaryDate = $this->calculateSalaryDate($date);

        return [
            'month' => $date->format('F'),
            'salary_date' => $salaryDate,
            'bonus_date' => null, // No bonus date in this strategy
        ];
    }

    private function calculateSalaryDate(\DateTime $date): string
    {
        $lastDayOfMonth = strtotime('last day of ' . $date->format('F Y'));

        // check if the day of the week of the last day of the month is Saturday (6) or Sunday (7) (if it's a weekend).
        if (date('N', $lastDayOfMonth) >= 6) {
            return date('Y-m-d', strtotime('last Friday', $lastDayOfMonth));
        }

        return date('Y-m-d', $lastDayOfMonth);
    }
}





