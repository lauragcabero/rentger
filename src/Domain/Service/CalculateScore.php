<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Entity\Ad;
use App\Domain\Interface\PicturePersistenceInterface;
use App\Domain\Interface\CalculateScoreInterface;
use App\Domain\ValueObject\Score;

final class CalculateScore implements CalculateScoreInterface
{
    public function __construct(private PicturePersistenceInterface $picturePersistenceInterface)
    {  
    }

    public function calculateScore(Ad $ad): int
    {
        return Score::calculateScore($ad, $this->picturePersistenceInterface)->getValue();
    }
}
