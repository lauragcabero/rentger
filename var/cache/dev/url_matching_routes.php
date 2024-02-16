<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/ads/calculate-score' => [[['_route' => 'calculate_score', '_controller' => 'App\\Infrastructure\\Api\\Controller\\CalculateScoreController::__invoke'], null, ['GET' => 0], null, false, false, null]],
        '/ads/public-listing' => [[['_route' => 'public_listing', '_controller' => 'App\\Infrastructure\\Api\\Controller\\PublicListingController::__invoke'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
