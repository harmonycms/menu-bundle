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
     * @var null|string $provider
     */
    protected $provider;

    /**
     * @return null|MenuDomain
     */
    public function getDomain(): ?MenuDomain
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

    /**
     * Get Provider
     *
     * @return null|string
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * Set Provider
     *
     * @param string $provider
     *
     * @return MenuItem
     */
    public function setProvider(string $provider): MenuItem
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'               => $this->getName(),
            'uri'                => $this->getUri(),
            'label'              => $this->getLabel(),
            'attributes'         => $this->getAttributes(),
            'linkAttributes'     => $this->getLinkAttributes(),
            'childrenAttributes' => $this->getChildrenAttributes(),
            'labelAttributes'    => $this->getLabelAttributes(),
            'extras'             => $this->getExtras(),
            'current'            => $this->isCurrent(),
            'display'            => $this->isDisplayed(),
            'displayChildren'    => $this->getDisplayChildren(),
            'domain'             => $this->getDomain(),
            'provider'           => $this->getProvider()
        ];
    }
}