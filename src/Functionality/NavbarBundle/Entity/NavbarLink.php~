<?php

namespace Functionality\NavbarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NavbarLink
 */
class NavbarLink
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
     * @var integer
     */
    private $weight;

    /**
     * @var boolean
     */
    private $enable;

    /**
     * @var boolean
     */
    private $linkEnable;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $childs;

    /**
     * @var \Functionality\NavbarBundle\Entity\NavbarLink
     */
    private $parent;

    /**
     * @var \Functionality\NavbarBundle\Entity\NavbarLinkRef
     */
    private $navbarLinkRef;

    /**
     * @var \Functionality\NavbarBundle\Entity\Navbar
     */
    private $navbar;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return NavbarLink
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
     * Set weight
     *
     * @param integer $weight
     * @return NavbarLink
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return NavbarLink
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set linkEnable
     *
     * @param boolean $linkEnable
     * @return NavbarLink
     */
    public function setLinkEnable($linkEnable)
    {
        $this->linkEnable = $linkEnable;

        return $this;
    }

    /**
     * Get linkEnable
     *
     * @return boolean 
     */
    public function getLinkEnable()
    {
        return $this->linkEnable;
    }

    /**
     * Add childs
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLink $childs
     * @return NavbarLink
     */
    public function addChild(\Functionality\NavbarBundle\Entity\NavbarLink $childs)
    {
        $this->childs[] = $childs;

        return $this;
    }

    /**
     * Remove childs
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLink $childs
     */
    public function removeChild(\Functionality\NavbarBundle\Entity\NavbarLink $childs)
    {
        $this->childs->removeElement($childs);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Set parent
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLink $parent
     * @return NavbarLink
     */
    public function setParent(\Functionality\NavbarBundle\Entity\NavbarLink $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Functionality\NavbarBundle\Entity\NavbarLink 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set navbarLinkRef
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLinkRef $navbarLinkRef
     * @return NavbarLink
     */
    public function setNavbarLinkRef(\Functionality\NavbarBundle\Entity\NavbarLinkRef $navbarLinkRef = null)
    {
        $this->navbarLinkRef = $navbarLinkRef;

        return $this;
    }

    /**
     * Get navbarLinkRef
     *
     * @return \Functionality\NavbarBundle\Entity\NavbarLinkRef 
     */
    public function getNavbarLinkRef()
    {
        return $this->navbarLinkRef;
    }

    /**
     * Set navbar
     *
     * @param \Functionality\NavbarBundle\Entity\Navbar $navbar
     * @return NavbarLink
     */
    public function setNavbar(\Functionality\NavbarBundle\Entity\Navbar $navbar = null)
    {
        $this->navbar = $navbar;

        return $this;
    }

    /**
     * Get navbar
     *
     * @return \Functionality\NavbarBundle\Entity\Navbar 
     */
    public function getNavbar()
    {
        return $this->navbar;
    }
}
