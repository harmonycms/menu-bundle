<?php

namespace Harmony\Bundle\MenuBundle\Config\Definition\Builder;

use Harmony\Bundle\CoreBundle\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class MenuNodeDefinition
 *
 * @package Harmony\Bundle\CoreBundle\Component\Config\Definition\Builder
 */
class MenuNodeDefinition extends ArrayNodeDefinition
{
    /**
     * Make menu hierarchy
     *
     * @param  int $depth
     *
     * @return MenuNodeDefinition
     */
    public function menuNodeHierarchy($depth = 10)
    {
        if ($depth == 0) {
            return $this;
        }

        return $this
            ->arrayPrototype()
                ->children()
                    ->scalarNode('route')->end()
                    ->arrayNode('routeParameters')
                        ->prototype('variable')
                        ->end()
                    ->end()
                    ->scalarNode('uri')->end()
                    ->scalarNode('label')->end()
                    ->booleanNode('display')->defaultTrue()->end()
                    ->booleanNode('displayChildren')->defaultTrue()->end()
                    ->integerNode('order')->end()
                    ->arrayNode('attributes')
                        ->prototype('variable')
                        ->end()
                    ->end()
                    ->arrayNode('linkAttributes')
                        ->prototype('variable')
                        ->end()
                    ->end()
                    ->arrayNode('childrenAttributes')
                        ->prototype('variable')
                        ->end()
                    ->end()
                    ->arrayNode('labelAttributes')
                        ->prototype('variable')
                        ->end()
                    ->end()
                    ->arrayNode('roles')
                        ->prototype('scalar')
                        ->end()
                    ->end()
                    ->arrayNode('extras')
                        ->prototype('scalar')
                        ->end()
                    ->end()
                    ->menuNode('children')->menuNodeHierarchy($depth - 1)
                ->end()
            ->end();
    }
}