<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_ZfcRoute
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */
$routeDefault = [
    'type' => 'Segment',
    'options' => [
        'route' => '/[:controller[/[:action]]]', // global route
        'constraints' => [
            'controller' => '[a-zA-Z]?[a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z]?[a-zA-Z0-9_-]*',
        ],
        'defaults' => [
            'controller' => 'index',
            'action' => 'index',
        ],
    ],
    'may_terminate' => true,
    'child_routes' => [
        'id' => [
            'type' => 'Segment',
            'priority' => 100,
            'options' => [
                'route' => '/:id', // edit/add route
                'constraints' => [
                    'id' => '[0-9]+',
                ],
                'defaults' => [
                    'id' => '',
                ],
            ],
            'may_terminate' => true,
            'child_routes' => [
                'wildcard' => [
                    'type' => 'Wildcard',
                    'options' => [],
                ],
            ],
        ],
        'parent' => [
            'type' => 'Segment',
            'priority' => 100,
            'options' => [
                'route' => '[/parent/:parent[/page/:page]]', // listing route
                'constraints' => [
                    'parent' => '[0-9]+',
                    'page' => '[0-9]+',
                ],
                'defaults' => [
                    'parent' => '0',
                    'page' => '1',
                ],
            ],
        ],
        'page' => [
            'type' => 'Segment',
            'priority' => 100,
            'options' => [
                'route' => '[/page:page]', // listing route
                'constraints' => [
                    'page' => '[0-9]+',
                ],
                'defaults' => [
                    'page' => '1',
                ],
            ],
        ],
        'wildcard' => [
            'type' => 'Wildcard',
            'priority' => 10,
            'options' => [
            ],
        ],
    ],
];

return [
    // default configuration for all modules
    'router' => [
        'routes' => [
            'default' => $routeDefault,
            // global frontend routes
            'home' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'index',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => $routeDefault,
                ],
            ],
            // global backend routes
            'admin' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/admin', //admin
                    'defaults' => [
                        'controller' => 'index',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => $routeDefault,
                ],
            ],
        ],
    ],
];