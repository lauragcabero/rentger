<?php

namespace App\Domain\Service;

use App\Domain\Entity\Ad;
use App\Domain\Enum\MinimumAdScore;

final class AdFilter
{
    public function __construct(private CalculateScore $calculateScore)
    {
    }

    public function filter(array $ads): array
    {
        return array_filter(
            $ads,
            fn(Ad $ad) => $this->calculateScore->calculateScore($ad) >= MinimumAdScore::Score->value
        );
    }
}
