<?php

namespace App\Application\UseCase;

use App\Application\DTO\PublicAd;
use App\Application\Service\DataRetrievalServiceInterface;
use App\Domain\Entity\Ad;
use App\Domain\Interface\CalculateScoreInterface;
use App\Domain\Service\AdFilter;

final class PublicListingUseCase
{
    public function __construct(
        private DataRetrievalServiceInterface $dataRetrievalService,
        private CalculateScoreInterface $calculateScore,
        private AdFilter $adFilter
    ) {
    }

    public function __invoke(?string $orderBy = null): array
    {
        $ads = $this->dataRetrievalService->getAds();
        $adsWithScoresAndFiltered = $this->toDTO($this->adFilter->filter($ads));
        if ($orderBy !== null) {
            usort($adsWithScoresAndFiltered, fn(PublicAd $ad1, PublicAd $ad2) => $ad2->score <=> $ad1->score);
            
            return $adsWithScoresAndFiltered;
        }
        
        return $adsWithScoresAndFiltered;
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
