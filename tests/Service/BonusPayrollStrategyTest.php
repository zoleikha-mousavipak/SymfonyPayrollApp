<?php

namespace App\Tests\Service;

use App\Service\BonusPayrollStrategy;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for BonusPayrollStrategy class.
 */
class BonusPayrollStrategyTest extends TestCase
{
    /**
     * Test case for generating bonus payroll data.
     *
     * @return void
     */
    public function testGeneratePayrollData()
    {
        $strategy = new BonusPayrollStrategy();
        $date = new \DateTime('2023-08-01'); // Assuming August 2023

        $payrollData = $strategy->generatePayrollData($date);

        // Expected bonus date for August 2023 is 2023-08-15 (adjusted to the next Wednesday)
        $this->assertEquals('2023-08-15', $payrollData['bonus_date']);
        $this->assertEquals('August', $payrollData['month']);
        $this->assertNull($payrollData['salary_date']); // No salary in BonusPayrollStrategy
    }
}
