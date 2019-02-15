<?php

namespace Harmony\Bundle\MenuBundle\Menu;

use Knp\Menu\ItemInterface as BaseItemInterface;

/**
 * Interface ItemInterface
 *
 * @package Harmony\Bundle\MenuBundle\Menu
 */
interface ItemInterface extends BaseItemInterface
{

    /**
     * Set a menu domain.
     *
     * @param MenuDomain $menuDomain
     *
     * @return ItemInterface
     */
    public function setDomain(MenuDomain $menuDomain): ItemInterface;
}