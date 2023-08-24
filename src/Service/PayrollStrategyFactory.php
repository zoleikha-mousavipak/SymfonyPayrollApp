<?php

namespace App\Service;

/**
 * Factory for creating payroll strategy instances.
 */
class PayrollStrategyFactory
{
    /**
     * Creates a new instance of MonthlyPayrollStrategy.
     *
     * @return MonthlyPayrollStrategy A new instance of MonthlyPayrollStrategy
     */
    public function createMonthlyStrategy(): MonthlyPayrollStrategy
    {
        return new MonthlyPayrollStrategy();
    }

    /**
     * Creates a new instance of BonusPayrollStrategy.
     *
     * @return BonusPayrollStrategy A new instance of BonusPayrollStrategy
     */
    public function createBonusStrategy(): BonusPayrollStrategy
    {
        return new BonusPayrollStrategy();
    }
}