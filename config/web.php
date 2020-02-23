<?php

declare(strict_types=1);

/**
 * Menu Sidebar Module for Mailery Platform
 * @link      https://github.com/maileryio/mailery-menu-sidebar
 * @package   Mailery\Menu\Sidebar
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2020, Mailery (https://mailery.io/)
 */

use Mailery\Menu\Sidebar\SidebarMenuFactory;
use Mailery\Menu\Sidebar\SidebarMenuInterface;

return [
    SidebarMenuInterface::class => new SidebarMenuFactory($params['menu']['sidebar']['items']),
];
