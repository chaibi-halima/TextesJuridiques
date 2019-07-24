<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Domaine
 *
 * @ORM\Table(name="domaine")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\DomaineRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\DomaineTraduction")
 */
class Domaine
{
    
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\SousCategorie1",mappedBy="domaine")
    */
    private $sousCategorie1s;
    
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\TexteJuridique",mappedBy="typetexte")
    */
    private $textesjuridiques;
    
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
     * @ORM\Column(name="domaine", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $domaine; 
    
    
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
     * Set domaine
     *
     * @param string $domaine
     *
     * @return Domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return string
     * 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousCategorie1s = new \Doctrine\Common\Collections\ArrayCollection();
        $this->textesjuridiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousCategorie1
     *
     * @param \Culture\JuridiqueBundle\Entity\SousCategorie1 $sousCategorie1
     *
     * @return Domaine
     */
    public function addSousCategorie1(\Culture\JuridiqueBundle\Entity\SousCategorie1 $sousCategorie1)
    {
        $this->sousCategorie1s[] = $sousCategorie1;

        return $this;
    }

    /**
     * Remove sousCategorie1
     *
     * @param \Culture\JuridiqueBundle\Entity\SousCategorie1 $sousCategorie1
     */
    public function removeSousCategorie1(\Culture\JuridiqueBundle\Entity\SousCategorie1 $sousCategorie1)
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
    
    /**
     * Add textesjuridique
     *
     * @param \Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique
     *
     * @return TypeTexte
     */
    public function addTextesjuridique(\Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique)
    {
        $this->textesjuridiques[] = $textesjuridique;
        return $this;
    }

    /**
     * Remove textesjuridique
     *
     * @param \Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique
     */
    public function removeTextesjuridique(\Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique)
    {
        $this->textesjuridiques->removeElement($textesjuridique);
    }

    /**
     * Get textesjuridiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextesjuridiques()
    {
        return $this->textesjuridiques;
    }
}
