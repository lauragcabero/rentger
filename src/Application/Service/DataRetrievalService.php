<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Interface\AdPersistenceInterface;
use App\Domain\Interface\PicturePersistenceInterface;

final class DataRetrievalService implements DataRetrievalServiceInterface
{
    public function __construct(
        private AdPersistenceInterface $adPersistence,
        private PicturePersistenceInterface $picturePersistence)
    {
    }

    public function getAds(): array
    {
        return $this->adPersistence->getAds();
    }

    public function getPictures(): array
    {
        return $this->picturePersistence->getPictures();
    }
}
