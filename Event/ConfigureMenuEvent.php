<?php

namespace Harmony\Bundle\MenuBundle\Event;

use Harmony\Bundle\MenuBundle\Menu\ItemInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ConfigureMenuEvent
 *
 * @package Harmony\Bundle\CoreBundle\Event
 */
class ConfigureMenuEvent extends Event
{

    /** Constant */
    const CONFIGURE = 'harmony_menu_configure';

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var ItemInterface
     */
    private $menu;

    /**
     * Constructor
     *
     * @param FactoryInterface $factory
     * @param ItemInterface    $menu
     */
    public function __construct(FactoryInterface $factory, ItemInterface $menu)
    {
        $this->factory = $factory;
        $this->menu    = $menu;
    }

    /**
     * @return FactoryInterface
     */
    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    /**
     * @return ItemInterface
     */
    public function getMenu(): ItemInterface
    {
        return $this->menu;
    }
}