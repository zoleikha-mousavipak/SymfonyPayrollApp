<?php

namespace App\Service;

class PayrollStrategyFactory
{
    public function createMonthlyStrategy(): MonthlyPayrollStrategy
    {
        return new MonthlyPayrollStrategy();
    }

    public function createBonusStrategy(): BonusPayrollStrategy
    {
        return new BonusPayrollStrategy();
    }
}