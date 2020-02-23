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
use Mailery\Menu\MenuItem;
use Mailery\Icon\Icon;

class SidebarMenu extends BaseMenu implements SidebarMenuInterface
{
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

        $resultItems = [];

        foreach ($items as $key => $item) {
            /* @var $item MenuItem */
            $resultItem = $item->toArray();

            $label = $level > 0 ? '{label}' : '<span class="menu-title">{label}</span>';
            if (!empty($resultItem['icon'])) {
                $label = Icon::widget()->options(['class' => 'menu-icon'])->name($resultItem['icon']) . ' ' . $label;
            }

            if (!empty($resultItem['childItems'])) {
                $collapseKey = $fnCollapseKey();

                $resultItem = array_merge(
                    $resultItem,
                    [
                        'url' => '#' . $collapseKey,
                        'template' => '<a class="nav-link collapsed" data-toggle="collapse" href="{url}">' . $label . Icon::widget()->options(['class' => 'menu-arrow'])->name('arrow-down') . '</a>',
                        'submenuTemplate' => "\n<div class=\"collapse\" id=\"{$collapseKey}\">\n<ul class=\"nav flex-column sub-menu\">\n{items}\n</ul>\n</div>\n",
                        'items' => $this->decorateItems($resultItem['childItems'], $level + 1),
                    ]
                );
            } else {
                $resultItem['template'] = '<a class="nav-link" href="{url}">' . $label . '</a>';
            }

            $resultItems[$key] = $resultItem;
        }

        return $resultItems;
    }

}
