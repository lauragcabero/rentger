<?php

namespace App\Tests\Application\UseCase;

use App\Application\DTO\PublicAd;
use App\Application\Service\DataRetrievalServiceInterface;
use App\Application\UseCase\PublicListingUseCase;
use App\Domain\Interface\CalculateScoreInterface;
use App\Domain\Service\AdFilter;
use App\Tests\Mother\AdMother;
use PHPUnit\Framework\TestCase;

final class PublicListingUseCaseTest extends TestCase
{
    public function test_public_listing_use_case(): void
    {
        $mockAds = [
            AdMother::createAd(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null),
            AdMother::createAd(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, null, null),
            AdMother::createAd(3, 'CHALET', '', [2], 300, null, null, null),
        ];

        $dataRetrievalService = $this->createMock(DataRetrievalServiceInterface::class);
        $dataRetrievalService->expects($this->once())
            ->method('getAds')
            ->willReturn($mockAds);

        $calculateScore = $this->createMock(CalculateScoreInterface::class);
        $calculateScore->method('calculateScore')
            ->willReturn(50);

        $adFilter = new AdFilter($calculateScore);

        $useCase = new PublicListingUseCase($dataRetrievalService, $calculateScore, $adFilter);

        $result = $useCase();

        $this->assertIsArray($result);
        foreach ($result as $publicAd) {
            $this->assertInstanceOf(PublicAd::class, $publicAd);
        }
    }
}
