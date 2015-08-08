<?php

namespace Functionality\NavbarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Navbar
 */
class Navbar
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $navbarLinks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->navbarLinks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Navbar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add navbarLinks
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLink $navbarLinks
     * @return Navbar
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
}
