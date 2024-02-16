<?php

namespace App\Tests\Mother;

use App\Domain\Entity\Ad;

final class AdMother
{
    public static function createAd(int $id, string $typology, string $description, array $pictures, int $houseSize, ?int $gardenSize): Ad
    {
        return new Ad($id, $typology, $description, $pictures, $houseSize, $gardenSize);
    }
}
