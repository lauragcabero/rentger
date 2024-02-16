<?php

declare(strict_types=1);

namespace App\Infrastructure\Api\Controller;

use App\Application\UseCase\CalculateScoreUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CalculateScoreController extends AbstractController
{
    public function __construct(private CalculateScoreUseCase $useCase)
    {
    }

    #[Route('/ads/calculate-score', name: 'ads_calculate_score', methods: ['GET'])]
    public function __invoke(CalculateScoreUseCase $useCase): JsonResponse
    {
        return new JsonResponse($useCase());
    }
}
