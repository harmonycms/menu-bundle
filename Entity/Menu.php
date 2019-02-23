<?php

namespace Harmony\Bundle\MenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Menu
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @package Harmony\Bundle\MenuBundle\Entity
 */
class Menu
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @var string $name
     */
    protected $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     * @var string $slug
     */
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="menu", cascade={"persist", "remove", "merge"},
     *                                         orphanRemoval=true)
     * @ORM\OrderBy({ "depth" = "ASC", "position" = "ASC" })
     * @var MenuItem $items
     */
    protected $items;

    /**
     * Menu constructor.
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return Menu
     */
    public function setId(int $id): Menu
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return Menu
     */
    public function setName(string $name): Menu
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set Slug
     *
     * @param string $slug
     *
     * @return Menu
     */
    public function setSlug(string $slug): Menu
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get Items
     *
     * @return MenuItem
     */
    public function getItems(): MenuItem
    {
        return $this->items;
    }

    /**
     * Set Items
     *
     * @param MenuItem $items
     *
     * @return Menu
     */
    public function setItems(MenuItem $items): Menu
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Remove item
     *
     * @param MenuItem $item
     */
    public function removeItem(MenuItem $item)
    {
        $this->items->removeElement($item);
        $item->setMenu(null);
    }

    /**
     * Add item
     *
     * @param MenuItem $item
     *
     * @return $this
     */
    public function addItem(MenuItem $item)
    {
        $item->setMenu($this);
        $this->items->add($item);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}