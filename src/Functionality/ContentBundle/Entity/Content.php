<?php

namespace Functionality\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 */
class Content
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
     * @var datetime
     */
    private $date;

    /**
     * @var text
     */
    private $content;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var boolean
     */
    private $published;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $streams;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $applications;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->streams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->applications = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Content
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
     * Set content
     *
     * @param string $content
     * @return Content
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Content
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Content
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Content
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Add streams
     *
     * @param \Functionality\ContentBundle\Entity\Stream $streams
     * @return Content
     */
    public function addStream(\Functionality\ContentBundle\Entity\Stream $streams)
    {
        $this->streams[] = $streams;

        return $this;
    }

    /**
     * Remove streams
     *
     * @param \Functionality\ContentBundle\Entity\Stream $streams
     */
    public function removeStream(\Functionality\ContentBundle\Entity\Stream $streams)
    {
        $this->streams->removeElement($streams);
    }

    /**
     * Get streams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStreams()
    {
        return $this->streams;
    }

    /**
     * Add applications
     *
     * @param \AppBundle\Entity\Application $applications
     * @return Content
     */
    public function addApplication(\AppBundle\Entity\Application $applications)
    {
        $this->applications[] = $applications;

        return $this;
    }

    /**
     * Remove applications
     *
     * @param \AppBundle\Entity\Application $applications
     */
    public function removeApplication(\AppBundle\Entity\Application $applications)
    {
        $this->applications->removeElement($applications);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApplications()
    {
        return $this->applications;
    }
}
