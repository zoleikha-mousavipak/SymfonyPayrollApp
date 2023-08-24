<?php

namespace App\Service;

/**
 * Strategy for calculating bonus payroll data.
 */
class BonusPayrollStrategy implements PayrollStrategyInterface
{
    public function generatePayrollData(\DateTime $date): array
    {
        // generate bonus payroll data
        $bonusDate = $this->calculateBonusDate($date);

        if (!$bonusDate) {
            throw new \Exception('Failed to calculate bonus date.');
        }

        return [
            'month' => $date->format('F'),
            'salary_date' => null, // No salary date in this strategy
            'bonus_date' => $bonusDate,
        ];
    }

    /**
     * Calculates the bonus payment date based on the provided date.
     *
     * @param \DateTime $date The date for which to calculate the bonus payment date
     * @return string The calculated bonus payment date as a string
     */
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
