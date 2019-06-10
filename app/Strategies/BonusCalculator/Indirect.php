<?php

namespace App\Strategies\BonusCalculator;

use App\Contracts\BonusCalculator;

class Indirect implements BonusCalculator
{
    /**
     * Calculate Bonus for the employee
     *
     * Since 2019.07.01 bonus for salaried employees is 0%
     *
     * @return float bonus percent value
     */
    public function calculate() {
    	return 0;
    };
}
