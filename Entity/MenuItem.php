<?php

namespace Harmony\Bundle\MenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class MenuItem
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @package Harmony\Bundle\MenuBundle\Entity
 */
class MenuItem
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @var string $title
     */
    protected $title;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     * @var string $url
     */
    protected $url;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     * @var boolean $active
     */
    protected $active = true;

    /**
     * @ORM\Column(name="target", type="string", length=255, nullable=true)
     * @var string $target
     */
    protected $target = '_self';

    /**
     * @ORM\Column(name="position", type="integer", nullable=false)
     * @Gedmo\SortablePosition()
     * @var integer $position
     */
    protected $position;

    /**
     * @ORM\Column(name="depth", type="integer", nullable=false)
     * @var integer $depth
     */
    protected $depth = 1;

    /**
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * @var MenuItem $parent
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parent", cascade={"persist"})
     * @ORM\OrderBy({ "position" = "ASC" })
     * @var MenuItem $children
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="items")
     * @var Menu $menu
     */
    protected $menu;

    /**
     * MenuItem constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
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
     * @return MenuItem
     */
    public function setId(int $id): MenuItem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set Title
     *
     * @param string $title
     *
     * @return MenuItem
     */
    public function setTitle(string $title): MenuItem
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get Url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set Url
     *
     * @param string $url
     *
     * @return MenuItem
     */
    public function setUrl(string $url): MenuItem
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get Active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Set Active
     *
     * @param bool $active
     *
     * @return MenuItem
     */
    public function setActive(bool $active): MenuItem
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get Target
     *
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * Set Target
     *
     * @param string $target
     *
     * @return MenuItem
     */
    public function setTarget(string $target): MenuItem
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get Position
     *
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Set Position
     *
     * @param int $position
     *
     * @return MenuItem
     */
    public function setPosition(int $position): MenuItem
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get Depth
     *
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }

    /**
     * Set Depth
     *
     * @param int $depth
     *
     * @return MenuItem
     */
    public function setDepth(int $depth): MenuItem
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get Parent
     *
     * @return MenuItem
     */
    public function getParent(): MenuItem
    {
        return $this->parent;
    }

    /**
     * Set Parent
     *
     * @param MenuItem $parent
     *
     * @return MenuItem
     */
    public function setParent(MenuItem $parent): MenuItem
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get Childrens
     *
     * @return MenuItem
     */
    public function getChildren(): MenuItem
    {
        return $this->children;
    }

    /**
     * Set Childrens
     *
     * @param MenuItem $children
     *
     * @return MenuItem
     */
    public function setChildren(MenuItem $children): MenuItem
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param MenuItem $children
     */
    public function removeChildren(MenuItem $children)
    {
        $this->children->removeElement($children);
        $children->setParent(null);
    }

    /**
     * Add children
     *
     * @param MenuItem $children
     */
    public function addChildren(MenuItem $children)
    {
        $children->setParent($this);
        $this->children->add($children);
    }

    /**
     * Get Menu
     *
     * @return Menu
     */
    public function getMenu(): Menu
    {
        return $this->menu;
    }

    /**
     * Set Menu
     *
     * @param Menu $menu
     *
     * @return MenuItem
     */
    public function setMenu(Menu $menu): MenuItem
    {
        $this->menu = $menu;

        return $this;
    }
}