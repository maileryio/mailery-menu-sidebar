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

use Psr\Container\ContainerInterface;

class SidebarMenuFactory
{
    /**
     * @var array
     */
    private array $items;

    /**
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param ContainerInterface $container
     * @return SidebarMenuInterface
     */
    public function __invoke(ContainerInterface $container): SidebarMenuInterface
    {
        $sidebarMenu = new SidebarMenu($container);
        $sidebarMenu->setItems($this->items);

        return $sidebarMenu;
    }
}
