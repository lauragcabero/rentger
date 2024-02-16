<?php

namespace App\Domain\Interface;

use App\Domain\Entity\Ad;

interface CalculateScoreInterface
{
    public function calculateScore(Ad $ad): int;
}
