<?php

namespace App\Service;

interface PayrollStrategyInterface
{
    public function generatePayrollData(\DateTime $date): array;

}
