<?php

namespace Harmony\Bundle\MenuBundle\Menu\Factory;

use Harmony\Bundle\MenuBundle\Menu\ItemInterface;
use Harmony\Bundle\MenuBundle\Menu\MenuDomain;
use Knp\Menu\Factory\CoreExtension as BaseCoreExtension;
use Knp\Menu\ItemInterface as KnpItemInterfaceAlias;

/**
 * Class CoreExtension
 *
 * @package Harmony\Bundle\MenuBundle\Menu\Factory
 */
class CoreExtension extends BaseCoreExtension
{

    /**
     * Configures the newly created item with the passed options
     *
     * @param KnpItemInterfaceAlias|ItemInterface $item
     * @param array                               $options
     */
    public function buildItem(KnpItemInterfaceAlias $item, array $options)
    {
        $item->setDomain(new MenuDomain());
        parent::buildItem($item, $options);
        if (isset($options['target'])) {
            $item->setLinkAttribute('target', $options['target']);
        }
    }
}