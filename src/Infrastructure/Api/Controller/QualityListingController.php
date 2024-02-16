<?php

declare(strict_types=1);

namespace App\Infrastructure\Api\Controller;

use App\Application\UseCase\QualityListingUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class QualityListingController extends AbstractController
{
    public function __construct(private QualityListingUseCase $useCase)
    {
    }

    #[Route('/ads/quality-listing', name: 'ads_quality_listing', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->useCase->__invoke());
    }
}
