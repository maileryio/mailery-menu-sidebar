<?php

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
