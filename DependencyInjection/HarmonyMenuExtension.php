<?php

namespace Harmony\Bundle\MenuBundle\DependencyInjection;

use Harmony\Bundle\MenuBundle\Provider\ConfigurationMenuProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class HarmonyMenuExtension
 *
 * @package Harmony\Bundle\MenuBundle\DependencyInjection
 */
class HarmonyMenuExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array            $configs   An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuredMenus = [];
        if (is_file($file = $container->getParameter('kernel.root_dir') . '/config/menu.yaml')) {
            $configuredMenus = Yaml::parse(file_get_contents(realpath($file)));
            $container->addResource(new FileResource($file));
        }
        foreach ($container->getParameter('kernel.bundles') as $bundle) {
            $reflection = new \ReflectionClass($bundle);
            if (is_file($file = dirname($reflection->getFileName()) . '/Resources/config/menu.yaml')) {
                $configuredMenus = array_replace_recursive($configuredMenus,
                    Yaml::parse(file_get_contents(realpath($file))));
                $container->addResource(new FileResource($file));
            }
        }

        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yaml');

        // validate menu configurations
        foreach ($configuredMenus as $rootName => $menuConfiguration) {
            $configuration                = new MenuConfiguration();
            $menuConfiguration[$rootName] = $this->processConfiguration($configuration->setMenuRootName($rootName),
                [$rootName => $menuConfiguration]);
        }

        // Set configuration to be used in a custom service
        $container->setParameter('harmony_menu.configuration', $configuredMenus);
        // Last argument of this service is always the menu configuration
        $container->getDefinition(ConfigurationMenuProvider::class)->setArgument('$configuration', $configuredMenus);
    }
}