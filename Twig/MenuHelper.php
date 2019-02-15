<?php

namespace Harmony\Bundle\MenuBundle\Twig;

use Harmony\Bundle\MenuBundle\Menu\ItemInterface;
use Knp\Menu\Matcher\MatcherInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Knp\Menu\Renderer\RendererProviderInterface;
use Knp\Menu\Twig\Helper;
use Knp\Menu\Util\MenuManipulator;

/**
 * Class MenuHelper
 *
 * @package Harmony\Bundle\MenuBundle\Twig
 */
class MenuHelper extends Helper
{

    protected $menuProvider;

    /**
     * MenuHelper constructor.
     *
     * @param RendererProviderInterface  $rendererProvider
     * @param MenuProviderInterface|null $menuProvider
     * @param MenuManipulator|null       $menuManipulator
     * @param MatcherInterface|null      $matcher
     */
    public function __construct(RendererProviderInterface $rendererProvider,
                                ?MenuProviderInterface $menuProvider = null, ?MenuManipulator $menuManipulator = null,
                                ?MatcherInterface $matcher = null)
    {
        $this->menuProvider = $menuProvider;
        parent::__construct($rendererProvider, $menuProvider, $menuManipulator, $matcher);
    }

    /**
     * Retrieves item in the menu, eventually using the menu provider.
     *
     * @param ItemInterface|string $menu
     * @param array                $path
     * @param array                $options
     *
     * @return ItemInterface|false
     * @throws \BadMethodCallException   when there is no menu provider and the menu is given by name
     * @throws \LogicException
     * @throws \InvalidArgumentException when the path is invalid
     */
    public function get($menu, array $path = [], array $options = [])
    {
        if (null === $this->menuProvider) {
            throw new \BadMethodCallException('A menu provider must be set to retrieve a menu');
        }

        if (!$menu instanceof ItemInterface && true === $this->menuProvider->has($menu, $options)) {
            $menuName = $menu;
            $menu     = $this->menuProvider->get($menuName, $options);

            if (!$menu instanceof ItemInterface) {
                throw new \LogicException(sprintf('The menu "%s" exists, but is not a valid menu item object. Check where you created the menu to be sure it returns an ItemInterface object.',
                    $menuName));
            }
        } elseif (!$menu instanceof ItemInterface) {
            return false;
        }

        foreach ($path as $child) {
            $menu = $menu->getChild($child);
            if (null === $menu) {
                throw new \InvalidArgumentException(sprintf('The menu has no child named "%s"', $child));
            }
        }

        return $menu;
    }
}