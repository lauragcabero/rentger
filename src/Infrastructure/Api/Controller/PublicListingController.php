<?php

declare(strict_types=1);

namespace App\Infrastructure\Api\Controller;

use App\Application\UseCase\PublicListingUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class PublicListingController extends AbstractController
{
    public function __construct(private PublicListingUseCase $useCase)
    {
    }

    #[Route('/ads/public-listing', name: 'ads_public_listing', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($this->useCase->__invoke($request->query->get('orderBy', 'score')));
    }
}
