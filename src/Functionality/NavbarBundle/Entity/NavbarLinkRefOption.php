<?php

namespace Functionality\NavbarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NavbarLinkRefOption
 */
class NavbarLinkRefOption
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $optionKey;

    /**
     * @var string
     */
    private $optionValue;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $navbarLinkRefs;

    /**
     * @var \Functionality\NavbarBundle\Entity\NavbarLinkRef
     */
    private $navbarLinkRef;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->navbarLinkRefs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set optionKey
     *
     * @param string $optionKey
     * @return NavbarLinkRefOption
     */
    public function setOptionKey($optionKey)
    {
        $this->optionKey = $optionKey;

        return $this;
    }

    /**
     * Get optionKey
     *
     * @return string 
     */
    public function getOptionKey()
    {
        return $this->optionKey;
    }

    /**
     * Set optionValue
     *
     * @param string $optionValue
     * @return NavbarLinkRefOption
     */
    public function setOptionValue($optionValue)
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    /**
     * Get optionValue
     *
     * @return string 
     */
    public function getOptionValue()
    {
        return $this->optionValue;
    }

    /**
     * Set navbarLinkRef
     *
     * @param \Functionality\NavbarBundle\Entity\NavbarLinkRef $navbarLinkRef
     * @return NavbarLinkRefOption
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
}
