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

use Mailery\Icon\Icon;
use Mailery\Menu\MenuInterface;

class SidebarMenu implements MenuInterface
{
    /**
     * @var MenuInterface
     */
    private MenuInterface $menu;

    /**
     * @param MenuInterface $menu
     */
    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->decorateItems(array_map(
            fn ($item) => $item->toArray(),
            $this->menu->getItems()
        ));
    }

    /**
     * @param array $items
     * @param int $level
     * @return array
     */
    private function decorateItems(array $items, int $level = 0): array
    {
        $id = 0;
        $fnCollapseKey = function () use (&$id) : string {
            return 'sidebar-item-' . ++$id;
        };

        foreach ($items as $key => $item) {
            $label = $level > 0 ? '{label}' : '<span class="menu-title">{label}</span>';
            if (!empty($item['icon'])) {
                $label = Icon::widget()
                    ->name($item['icon'])
                    ->options([
                        'class' => 'menu-icon',
                        'encode' => false,
                    ]) . ' ' . $label;
            }

            if (!empty($item['items'])) {
                $collapseKey = $fnCollapseKey();

                $item = array_merge(
                    $item,
                    [
                        'url' => '#' . $collapseKey,
                        'template' => '<a class="nav-link" data-toggle="collapse" href="{url}">' . $label . Icon::widget()->options(['class' => 'menu-arrow', 'encode' => false])->name('chevron-right') . '</a>',
                        'submenuTemplate' => "\n<div class=\"collapse\" id=\"{$collapseKey}\">\n<ul class=\"nav flex-column sub-menu\">\n{items}\n</ul>\n</div>\n",
                        'items' => $this->decorateItems($item['items'], $level + 1),
                    ]
                );
            } else {
                $item['template'] = '<a class="nav-link" href="{url}">' . $label . '</a>';
            }

            $items[$key] = $item;
        }

        return $items;
    }
}
