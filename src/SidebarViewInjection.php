<?php

declare(strict_types=1);

namespace Mailery\Menu\Sidebar;

use Mailery\Menu\Sidebar\SidebarMenu;
use Yiisoft\Yii\View\CommonParametersInjectionInterface;

class SidebarViewInjection implements CommonParametersInjectionInterface
{
    /**
     * @param SidebarMenu $sidebarMenu
     */
    public function __construct(
        private SidebarMenu $sidebarMenu
    ) {}

    /**
     * @return array
     */
    public function getCommonParameters(): array
    {
        return [
            'sidebarMenu' => $this->sidebarMenu,
        ];
    }
}
