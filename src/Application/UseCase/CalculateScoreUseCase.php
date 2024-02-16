<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Ad;
use App\Application\DTO\PublicAd;
use App\Application\Service\DataRetrievalServiceInterface;
use App\Domain\Interface\CalculateScoreInterface;

final class CalculateScoreUseCase
{
    public function __construct(
        private DataRetrievalServiceInterface $dataRetrievalService,
        private CalculateScoreInterface $calculateScore
    ) {
    }

    public function __invoke(): array
    {
        $ads = $this->dataRetrievalService->getAds();

        return $this->toDTO($ads);
    }

    private function toDTO(array $ads) : array
    {
        return array_map(
            fn(Ad $ad) => new PublicAd(
                $ad->getId(),
                $ad->getTypology(),
                $ad->getDescription(),
                $ad->getPictures(),
                $ad->getHouseSize(),
                $ad->getGardenSize(),
                $this->calculateScore->calculateScore($ad)
            ),
            $ads
        );
    }
}
