<?php

declare(strict_types=1);

/**
 * Menu Sidebar Module for Mailery Platform
 * @link      https://github.com/maileryio/mailery-menu-sidebar
 * @package   Mailery\Menu\Sidebar
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2020, Mailery (https://mailery.io/)
 */

namespace Mailery\Menu\Sidebar;

use Mailery\Menu\BaseMenu;

class SidebarMenu extends BaseMenu implements SidebarMenuInterface
{
    /**
     * {@inheritdoc}
     */
    public function getKey(): string
    {
        return 'sidebar-menu';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return 'Sidebar Menu';
    }
}
