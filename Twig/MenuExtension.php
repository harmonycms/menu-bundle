<?php

namespace Harmony\Bundle\MenuBundle\Twig;

use Harmony\Bundle\MenuBundle\Menu\ItemInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class MenuExtension
 *
 * @package Harmony\Bundle\MenuBundle\Twig
 */
class MenuExtension extends AbstractExtension
{

    /** @var MenuHelper $helper */
    protected $helper;

    /**
     * MenuExtension constructor.
     *
     * @param MenuHelper $helper
     */
    public function __construct(MenuHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('menu_render', [$this, 'render'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Renders a menu with the specified renderer.
     *
     * @param ItemInterface|string $menu
     * @param array                $options
     * @param null                 $renderer
     *
     * @return string
     */
    public function render($menu, array $options = [], $renderer = null): string
    {
        if (false !== $menuInterface = $this->helper->get($menu)) {
            if (isset($options['childrenAttributes'])) {
                $menuInterface->setChildrenAttributes($options['childrenAttributes']);
                unset($options['childrenAttributes']);
            }
            foreach ($menuInterface->getChildren() as $child) {
                if (isset($options['attributes'])) {
                    $child->setAttributes($options['attributes']);
                }
                if (isset($options['linkAttributes'])) {
                    $child->setLinkAttributes($options['linkAttributes']);
                }
            }
            unset($options['attributes']);
            unset($options['linkAttributes']);

            return $this->helper->render($menuInterface, $options, $renderer);
        }

        return '';
    }
}