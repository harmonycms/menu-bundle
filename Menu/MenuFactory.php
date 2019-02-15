<?php

namespace Harmony\Bundle\MenuBundle\Menu;

use Harmony\Bundle\MenuBundle\Menu\Factory\CoreExtension;
use Knp\Menu\Factory\ExtensionInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

/**
 * Class MenuFactory
 *
 * @package Harmony\Bundle\MenuBundle\Menu
 */
class MenuFactory implements FactoryInterface
{

    /** @var array[] $extensions */
    protected $extensions = [];

    /** @var ExtensionInterface[] $sorted */
    protected $sorted;

    /**
     * MenuFactory constructor.
     */
    public function __construct()
    {
        $this->addExtension(new CoreExtension(), - 10);
    }

    /**
     * Creates a menu item
     *
     * @param string $name
     * @param array  $options
     *
     * @return ItemInterface
     */
    public function createItem($name, array $options = []): ItemInterface
    {
        foreach ($this->getExtensions() as $extension) {
            $options = $extension->buildOptions($options);
        }

        $item = new MenuItem($name, $this);

        foreach ($this->getExtensions() as $extension) {
            $extension->buildItem($item, $options);
        }

        return $item;
    }

    /**
     * Adds a factory extension
     *
     * @param ExtensionInterface $extension
     * @param integer            $priority
     */
    public function addExtension(ExtensionInterface $extension, $priority = 0)
    {
        $this->extensions[$priority][] = $extension;
        $this->sorted                  = null;
    }

    /**
     * Sorts the internal list of extensions by priority.
     *
     * @return ExtensionInterface[]
     */
    protected function getExtensions()
    {
        if (null === $this->sorted) {
            krsort($this->extensions);
            $this->sorted = !empty($this->extensions) ? call_user_func_array('array_merge', $this->extensions) : [];
        }

        return $this->sorted;
    }
}