<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\serviceRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\serviceTraduction")
 */
class service
{
    /**
    * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\Direction",inversedBy="directions")
    * @ORM\JoinColumn(nullable=false)
    */
    private $direction;
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
     * @ORM\Column(name="titre", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="brochure", type="string", length=255)
     */
    private $brochure;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return service
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set brochure
     *
     * @param string $brochure
     *
     * @return service
     */
    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * Get brochure
     *
     * @return string
     */
    public function getBrochure()
    {
        return $this->brochure;
    }

    

    /**
     * Set direction
     *
     * @param \Culture\JuridiqueBundle\Entity\Direction $direction
     *
     * @return service
     */
    public function setDirection(\Culture\JuridiqueBundle\Entity\Direction $direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return \Culture\JuridiqueBundle\Entity\Direction
     */
    public function getDirection()
    {
        return $this->direction;
    }
}
