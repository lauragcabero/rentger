<?php

declare(strict_types=1);

namespace App\Domain\Interface;

use App\Domain\Entity\Picture;

interface PicturePersistenceInterface
{
    public function getPictures(): array;
    public function findById(int $id): ?Picture;
}
