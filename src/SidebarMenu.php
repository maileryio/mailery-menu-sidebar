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
use Mailery\Icon\Icon;

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

    /**
     * {@inheritdoc}
     */
    public function getItems(): array
    {
        return $this->decorateItems(parent::getItems());
    }

    /**
     * @param array $items
     * @param int $level
     * @return array
     */
    private function decorateItems(array $items, int $level = 0): array
    {
        $id = 0;
        $fnCollapseKey = function () use(&$id) : string {
            return 'sidebar-menu-item-' . ++$id;
        };

        foreach ($items as &$item) {
            $label = $level > 0 ? '{label}' : '<span class="menu-title">{label}</span>';

            if (isset($item['icon'])) {
                $label = Icon::widget()->options(['class' => 'menu-icon'])->name($item['icon']) . $label;
            }

            if (isset($item['items'])) {
                $collapseKey = $fnCollapseKey();

                $item['url'] = '#' . $collapseKey;
                $item['template'] = '<a class="nav-link collapsed" data-toggle="collapse" href="{url}">' . $label . Icon::widget()->options(['class' => 'menu-arrow'])->name('arrow-down') . '</a>';
                $item['submenuTemplate'] = "\n<div class=\"collapse\" id=\"{$collapseKey}\">\n<ul class=\"nav flex-column sub-menu\">\n{items}\n</ul>\n</div>\n";

                $item['items'] = $this->decorateItems($item['items'], $level + 1);
            } else {
                $item['template'] = '<a class="nav-link" href="{url}">' . $label . '</a>';
            }
        }

        return $items;
    }

}
