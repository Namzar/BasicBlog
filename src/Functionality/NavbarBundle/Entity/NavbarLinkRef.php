<?php

namespace Functionality\NavbarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NavbarLinkRef
 */
class NavbarLinkRef
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $routePath;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $navbarLinks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $navbarLinkRefOptions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->navbarLinks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->navbarLinkRefOptions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set routePath
     *
     * @param string $routePath
     * @return NavbarLinkRef
     */
    public function setRoutePath($routePath)
    {
        $this->routePath = $routePath;

        return $this;
    }

    /**
     * Get routePath
     *
     * @return string 
     */
    public function getRoutePath()
    {
        return $this->routePath;
    }

    /**
     * Add navbarLinks
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLink $navbarLinks
     * @return NavbarLinkRef
     */
    public function addNavbarLink(\Functionality\NavbarBundle\Entity\NavbarLink $navbarLinks)
    {
        $this->navbarLinks[] = $navbarLinks;

        return $this;
    }

    /**
     * Remove navbarLinks
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLink $navbarLinks
     */
    public function removeNavbarLink(\Functionality\NavbarBundle\Entity\NavbarLink $navbarLinks)
    {
        $this->navbarLinks->removeElement($navbarLinks);
    }

    /**
     * Get navbarLinks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNavbarLinks()
    {
        return $this->navbarLinks;
    }

    /**
     * Add navbarLinkRefOptions
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLinkRefOption $navbarLinkRefOptions
     * @return NavbarLinkRef
     */
    public function addNavbarLinkRefOption(\Functionality\NavbarBundle\Entity\NavbarLinkRefOption $navbarLinkRefOptions)
    {
        $this->navbarLinkRefOptions[] = $navbarLinkRefOptions;

        return $this;
    }

    /**
     * Remove navbarLinkRefOptions
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLinkRefOption $navbarLinkRefOptions
     */
    public function removeNavbarLinkRefOption(\Functionality\NavbarBundle\Entity\NavbarLinkRefOption $navbarLinkRefOptions)
    {
        $this->navbarLinkRefOptions->removeElement($navbarLinkRefOptions);
    }

    /**
     * Get navbarLinkRefOptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNavbarLinkRefOptions()
    {
        return $this->navbarLinkRefOptions;
    }
}
