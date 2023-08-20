<?php

namespace App\Service;

class PayrollGenerator
{

    public function getNextSalaryPaymentDate($date) {
        // F will output the month in a word, For example, January.
        // Y will output the year using 4 digits. For example, 1993
        $lastDayOfMonth = strtotime('last day of ' . date('F Y', $date));
        // check if the day of the week of the last day of the month is Saturday (6) or Sunday (7) (if it's a weekend).
        if (date('N', $lastDayOfMonth) >= 6) {
            return strtotime('last Friday of ' . date('F Y', $date));
        }
        return $lastDayOfMonth;
    }
    
    public function getNextBonusPaymentDate($date) {
        $fifteenthOfMonth = strtotime('15th ' . date('F Y', $date));
        if (date('N', $fifteenthOfMonth) >= 6) {
            return strtotime('next Wednesday', $fifteenthOfMonth);
        }
        return $fifteenthOfMonth;
    }
    
    public function generateCSV(string $filename)
    {       
        // Array of month, salary date, and bonus date
        $csvData = []; 
        
        $currentDate = time();

        for ($i = 0; $i < 12; $i++) {
            $monthName = date('F', $currentDate);

            $salaryDate = $this->getNextSalaryPaymentDate($currentDate);
            $bonusDate = $this->getNextBonusPaymentDate($currentDate);

            $csvData[] = [$monthName, date('Y-m-d', $salaryDate), date('Y-m-d', $bonusDate)];

            $currentDate = strtotime('+1 month', $currentDate);
        }
        
        $handle = fopen($filename, 'w');
        fputcsv($handle, ['Month', 'Salary Date', 'Bonus Date']);
        
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        
        fclose($handle);
    }
}
