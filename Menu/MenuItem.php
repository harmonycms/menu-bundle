<?php

namespace Harmony\Bundle\MenuBundle\Menu;

use Knp\Menu\MenuItem as BaseMenuItem;

/**
 * Class MenuItem
 *
 * @package Harmony\Bundle\MenuBundle\Menu
 */
class MenuItem extends BaseMenuItem implements ItemInterface
{

    /**
     * @var MenuDomain $domain
     */
    protected $domain;

    /**
     * @return MenuDomain
     */
    public function getDomain(): MenuDomain
    {
        return $this->domain;
    }

    /**
     * @param MenuDomain $domain
     *
     * @return MenuItem
     */
    public function setDomain(MenuDomain $domain): ItemInterface
    {
        $this->domain = $domain;

        return $this;
    }
}