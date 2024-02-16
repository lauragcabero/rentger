<?php

namespace App\Application\UseCase;

use App\Application\DTO\PublicAd;
use App\Application\Service\DataRetrievalServiceInterface;
use App\Domain\Entity\Ad;
use App\Domain\Interface\CalculateScoreInterface;

final class QualityListingUseCase
{
    public function __construct(
        private DataRetrievalServiceInterface $dataRetrievalService,
        private CalculateScoreInterface $calculateScore,
    ) {
    }

    public function __invoke(): array
    {
        $ads = $this->dataRetrievalService->getAds();
        $adsDTOWithScores = $this->toDTO($ads);

        return array_filter($adsDTOWithScores, fn(PublicAd $ad) => $ad->score < 40);
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
                $this->calculateScore->calculateScore($ad),
                $ad->getIrrelevantSince()
            ),
            $ads
        );
    }
}
