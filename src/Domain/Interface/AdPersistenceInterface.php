<?php

declare(strict_types=1);

namespace App\Domain\Interface;

interface AdPersistenceInterface
{
    public function getAds(): array;
}
