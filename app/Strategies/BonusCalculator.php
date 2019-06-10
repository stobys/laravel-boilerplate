<?php

namespace App\Strategies;

use App\Contracts\BonusCalculator as BonusCalculatorContract;

class BonusCalculator
{
    private $calculator;

    public function __constructor(BonusCalculatorContract $calculator)
    {
        $this -> calculator = $calculator();
    }
}
