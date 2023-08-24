<?php

namespace App\Service;

/**
 * Interface for payroll strategy classes.
 */
interface PayrollStrategyInterface
{
    /**
     * Generates payroll data based on the provided date.
     *
     * @param \DateTime $date The date for which to generate payroll data
     * @return array The generated payroll data as an array
     */
    public function generatePayrollData(\DateTime $date): array;

}
