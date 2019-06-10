<?php

namespace App\Contracts;

interface BonusCalculator
{
    /**
     * Calculate Bonus for the employee
     *
     * @return float bonus percent value
     */
    public function calculate();
}
