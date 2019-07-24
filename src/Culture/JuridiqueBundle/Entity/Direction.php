<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Direction
 *
 * @ORM\Table(name="direction")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\DirectionRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\DirectionTraduction")
 */
class Direction
{ 
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\service",mappedBy="direction")
    */
    private $services;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $direction;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return Direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Add service
     *
     * @param \Culture\JuridiqueBundle\Entity\service $service
     *
     * @return Direction
     */
    public function addService(\Culture\JuridiqueBundle\Entity\service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Culture\JuridiqueBundle\Entity\service $service
     */
    public function removeService(\Culture\JuridiqueBundle\Entity\service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}
