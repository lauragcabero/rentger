<?php

declare(strict_types=1);

namespace App\Application\DTO;

final class PublicAd
{
    public function __construct(
        public int $id,
        public string $typology,
        public string $description,
        public array $pictureUrls,
        public int $houseSize,
        public ?int $gardenSize = null,
        public ?int $score = null
    ) {
    }
}
