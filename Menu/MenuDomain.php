<?php

namespace Harmony\Bundle\MenuBundle\Menu;

/**
 * Class MenuDomain
 *
 * @package Harmony\Bundle\MenuBundle\Menu
 */
class MenuDomain
{

    /** Constant */
    public const DEFAULT_NAME = 'default';

    /** @var string $name */
    protected $name;

    /**
     * MenuDomain constructor.
     *
     * @param string $name
     */
    public function __construct(string $name = self::DEFAULT_NAME)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return MenuDomain
     */
    public function setName(string $name): MenuDomain
    {
        $this->name = $name;

        return $this;
    }
}