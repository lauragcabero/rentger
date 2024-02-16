<?php

namespace App\Tests\Application\UseCase;

use App\Application\DTO\PublicAd;
use App\Application\Service\DataRetrievalServiceInterface;
use App\Application\UseCase\CalculateScoreUseCase;
use App\Domain\Interface\CalculateScoreInterface;
use App\Tests\Mother\AdMother;
use PHPUnit\Framework\TestCase;

final class CalculateScoreUseCaseTest extends TestCase
{
    public function test_calculate_score_use_case(): void
    {
        $mockAds = [
            AdMother::createAd(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null),
        ];

        $dataRetrievalService = $this->createMock(DataRetrievalServiceInterface::class);
        $dataRetrievalService->expects($this->once())
            ->method('getAds')
            ->willReturn($mockAds);

        $calculateScore = $this->createMock(CalculateScoreInterface::class);
        $calculateScore->expects($this->once())
            ->method('calculateScore')
            ->willReturn(0);

        $useCase = new CalculateScoreUseCase($dataRetrievalService, $calculateScore);
        $result = $useCase();
        $this->assertIsArray($result);

        foreach ($result as $publicAd) {
            $this->assertInstanceOf(PublicAd::class, $publicAd);
        }
    }
}
