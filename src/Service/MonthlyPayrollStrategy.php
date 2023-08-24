<?php

namespace App\Service;

/**
 * Strategy for calculating monthly payroll data.
 */
class MonthlyPayrollStrategy implements PayrollStrategyInterface
{
    /**
     * Generates monthly payroll data based on the provided date.
     *
     * @param \DateTime $date The date for which to generate the monthly payroll data
     * @return array The generated monthly payroll data as an array
     */
    public function generatePayrollData(\DateTime $date): array
    {
        // generate monthly payroll data
        $salaryDate = $this->calculateSalaryDate($date);

        if (!$salaryDate) {
            throw new \Exception('Failed to calculate salary date.');
        }

        return [
            'month' => $date->format('F'),
            'salary_date' => $salaryDate,
            'bonus_date' => null, // No bonus date in this strategy
        ];
    }

    /**
     * Calculates the salary payment date based on the provided date.
     *
     * @param \DateTime $date The date for which to calculate the salary payment date
     * @return string The calculated salary payment date as a string
     */
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





