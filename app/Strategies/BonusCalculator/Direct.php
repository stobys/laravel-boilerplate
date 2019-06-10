<?php

namespace App\Strategies\BonusCalculator;

use App\Contracts\BonusCalculator;

class Direct implements BonusCalculator
{
    /**
     * Calculate Bonus for the employee
     *
     * Calculated based on SAP times
     *
     * @return float bonus percent value
     */
    public function calculate() : float
    {
    	return 10;
    };
}
