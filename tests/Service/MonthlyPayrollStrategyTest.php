<?php

namespace App\Tests\Service;

use App\Service\MonthlyPayrollStrategy;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for MonthlyPayrollStrategy class.
 */
class MonthlyPayrollStrategyTest extends TestCase
{
    /**
     * Test case for generating monthly payroll data.
     *
     * @return void
     */
    public function testGeneratePayrollData()
    {
        $strategy = new MonthlyPayrollStrategy();
        $date = new \DateTime('2023-08-01'); // Assuming August 2023

        $payrollData = $strategy->generatePayrollData($date);

        // Expected salary date for August 2023 is 2023-08-31 (last working day)
        $this->assertEquals('2023-08-31', $payrollData['salary_date']);
        $this->assertEquals('August', $payrollData['month']);
        $this->assertNull($payrollData['bonus_date']); // No bonus in MonthlyPayrollStrategy
    }
}
