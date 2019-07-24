<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * SousCategorie2
 *
 * @ORM\Table(name="sous_categorie2")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\SousCategorie2Repository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\SousCategorie2Traduction")
 */
class SousCategorie2
{
    /**
    * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\SousCategorie1",inversedBy="sousCategorie2s")
    * @ORM\JoinColumn(nullable=false)
    */
    private $sousCategorie1;
    
    /**
    * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\Domaine",inversedBy="sousCategorie1s")
    * @ORM\JoinColumn(nullable=false)
    */
    private $domaine;
    
    public function __construct()
    {
        $this->sousCategorie1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->domaine = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @ORM\Column(name="sous_categorie2", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $sousCategorie2;


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
     * Set sousCategorie2
     *
     * @param string $sousCategorie2
     *
     * @return SousCategorie2
     */
    public function setSousCategorie2($sousCategorie2)
    {
        $this->sousCategorie2 = $sousCategorie2;

        return $this;
    }

    /**
     * Get sousCategorie2
     *
     * @return string
     */
    public function getSousCategorie2()
    {
        return $this->sousCategorie2;
    }

    /**
     * Set sousCategorie1
     *
     * @param \Culture\JuridiqueBundle\Entity\SousCategorie1 $sousCategorie1
     *
     * @return SousCategorie2
     */
    public function setSousCategorie1(\Culture\JuridiqueBundle\Entity\SousCategorie1 $sousCategorie1)
    {
        $this->sousCategorie1 = $sousCategorie1;

        return $this;
    }

    /**
     * Get sousCategorie1
     *
     * @return \Culture\JuridiqueBundle\Entity\SousCategorie1
     */
    public function getSousCategorie1()
    {
        return $this->sousCategorie1;
    }

    /**
     * Set domaine
     *
     * @param \Culture\JuridiqueBundle\Entity\Domaine $domaine
     *
     * @return SousCategorie2
     */
    public function setDomaine(\Culture\JuridiqueBundle\Entity\Domaine $domaine)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return \Culture\JuridiqueBundle\Entity\Domaine
     */
    public function getDomaine()
    {
        return $this->domaine;
    }
}
