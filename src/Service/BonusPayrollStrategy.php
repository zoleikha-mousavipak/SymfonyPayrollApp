<?php

namespace App\Service;

class BonusPayrollStrategy implements PayrollStrategyInterface
{
    public function generatePayrollData(\DateTime $date): array
    {
        // generate bonus payroll data
        $bonusDate = $this->calculateBonusDate($date);

        return [
            'month' => $date->format('F'),
            'salary_date' => null, // No salary date in this strategy
            'bonus_date' => $bonusDate,
        ];
    }

    private function calculateBonusDate(\DateTime $date): string
    {
        $bonusDate = new \DateTime($date->format('Y-m-15'));

        // Check if bonus date is a weekend
        if ($bonusDate->format('N') >= 6) { // Saturday or Sunday
            $bonusDate = $bonusDate->modify('next Wednesday');
        }

        return $bonusDate->format('Y-m-d');
    }
}
