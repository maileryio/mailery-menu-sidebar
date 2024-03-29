<?php

declare(strict_types=1);

use Mailery\Menu\Sidebar\SidebarViewInjection;
use Yiisoft\Definitions\Reference;

/**
 * Menu Sidebar Module for Mailery Platform
 * @link      https://github.com/maileryio/mailery-menu-sidebar
 * @package   Mailery\Menu\Sidebar
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2020, Mailery (https://mailery.io/)
 */

return [
    'maileryio/mailery-menu-sidebar' => [
        'items' => [],
    ],

    'yiisoft/yii-view' => [
        'injections' => [
            Reference::to(SidebarViewInjection::class),
        ],
    ],
];
