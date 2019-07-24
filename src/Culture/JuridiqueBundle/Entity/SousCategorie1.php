<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * SousCategorie1
 *
 * @ORM\Table(name="sous_categorie1")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\SousCategorie1Repository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\SousCategorie1Traduction")
 */
class SousCategorie1
{
    /**
    * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\Domaine",inversedBy="sousCategorie1s")
    * @ORM\JoinColumn(nullable=false)
    */
    private $domaine;
    
    public function __construct()
    {
        $this->domaine = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\SousCategorie2",mappedBy="sousCategorie1")
    */
    private $sousCategorie1s;
    
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
     * @ORM\Column(name="SousCategorie1", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $sousCategorie1;


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
     * Set sousCategorie1
     *
     * @param string $sousCategorie1
     *
     * @return SousCategorie1
     */
    public function setSousCategorie1($sousCategorie1)
    {
        $this->sousCategorie1 = $sousCategorie1;

        return $this;
    }

    /**
     * Get sousCategorie1
     *
     * @return string
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
     * @return SousCategorie1
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

    /**
     * Add sousCategorie1
     *
     * @param \Culture\JuridiqueBundle\Entity\SousCategorie2 $sousCategorie1
     *
     * @return SousCategorie1
     */
    public function addSousCategorie1(\Culture\JuridiqueBundle\Entity\SousCategorie2 $sousCategorie1)
    {
        $this->sousCategorie1s[] = $sousCategorie1;

        return $this;
    }

    /**
     * Remove sousCategorie1
     *
     * @param \Culture\JuridiqueBundle\Entity\SousCategorie2 $sousCategorie1
     */
    public function removeSousCategorie1(\Culture\JuridiqueBundle\Entity\SousCategorie2 $sousCategorie1)
    {
        $this->sousCategorie1s->removeElement($sousCategorie1);
    }

    /**
     * Get sousCategorie1s
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousCategorie1s()
    {
        return $this->sousCategorie1s;
    }
}
