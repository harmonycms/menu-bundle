# HarmonyMenuBundle
This bundle is part of the [HarmonyCMS] and licensed under the [LGPLv3 License].

The HarmonyMenuBundle is on top of the [KnpMenuBundle] and adds the following features:
* Configure menus in YAML configuration files,
* Store menu items in a database.

Features are based on [ConfigKnpMenuBundle] and [KtwDatabaseMenuBundle] bundles.

## Installation
```
composer require harmony/menu-bundle
```

## Quick start
In order to use this bundle, you must define your menu configuration in a **menu.yaml** file in your bundle.

Example:
``` yaml
my_mega_menu:
    tree:
        first_level_item:
            label: My first label
            children:
                second_level_item:
                    label: My second level
```

It will configure a provider for knp menu factory. You can then use your `my_mega_menu` in twig as a classic knp menu:
``` twig
{{ knp_menu_render('my_mega_menu') }}
```

## Configuration reference
This is the available configuration definition for an item.

``` yml
my_mega_menu:
    childrenAttributes: An array of attributes passed to the root ul tag
    tree:
        first_level_item:
            uri: "An uri. Use it if you do not define route parameter"
            route: "A sf2 route without @"
            routeParameters: "an array of parameters to pass to the route"
            label: "My first label"
            order: An integer to sort the item in his level.
            attributes: An array of attributes passed to the knp item
            linkAttributes: An array of attributes passed to the a tag
            childrenAttributes: An array of attributes passed to the chidlren block
            labelAttributes: An array of attributes passed to the label tag
            display: boolean to hide the item
            displayChildren: boolean to hide the children
            roles: array of item (string roles) passed to isGranted securityContext method to check if user has rights in menu items
            extras: An array of extra parameters (for example icon img, additional content etc.)
            children: # An array of subitems
                second_level_item:
                    label: My second level
```
> This configuration matches the methods available in the Knp Menu Item class

[HarmonyCMS]: https://harmonycms.net
[LGPLv3 License]: https://opensource.org/licenses/lgpl-3.0.html
[KnpMenuBundle]: https://packagist.org/packages/knplabs/knp-menu-bundle
[ConfigKnpMenuBundle]: https://packagist.org/packages/jbouzekri/config-knp-menu-bundle
[KtwDatabaseMenuBundle]: https://packagist.org/packages/kevintweber/ktw-database-menu-bundle
