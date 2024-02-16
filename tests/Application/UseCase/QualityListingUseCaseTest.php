<?php

namespace App\Tests\Application\UseCase;

use App\Application\Service\DataRetrievalServiceInterface;
use App\Application\UseCase\QualityListingUseCase;
use App\Domain\Interface\CalculateScoreInterface;
use App\Tests\Mother\AdMother;
use PHPUnit\Framework\TestCase;

final class QualityListingUseCaseTest extends TestCase
{
    public function test_quality_listing_use_case()
    {
        $mockAds = [
            AdMother::createAd(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null),
            AdMother::createAd(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, null, null),
            AdMother::createAd(3, 'CHALET', '', [2], 300, null, null, null),
        ];

        $dataRetrievalService = $this->createMock(DataRetrievalServiceInterface::class);
        $calculateScore = $this->createMock(CalculateScoreInterface::class);

        $dataRetrievalService->expects($this->once())
            ->method('getAds')
            ->willReturn($mockAds);

        $calculateScore->expects($this->any())
            ->method('calculateScore')
            ->willReturn(30);

        $useCase = new QualityListingUseCase($dataRetrievalService, $calculateScore);

        $result = $useCase();

        $this->assertIsArray($result);

        foreach ($result as $ad) {
            $this->assertLessThan(40, $ad->score);
        }
    }
}
