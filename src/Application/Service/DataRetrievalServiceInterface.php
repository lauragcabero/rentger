<?php

declare(strict_types=1);

namespace App\Application\Service;

interface DataRetrievalServiceInterface
{
    public function getAds(): array;
    public function getPictures(): array;
}
