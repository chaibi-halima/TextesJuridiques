<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * StatutTexte
 *
 * @ORM\Table(name="statut_texte")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\StatutTexteRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\StatutTexteTraduction") 
 */
class StatutTexte
{
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\TexteJuridique",mappedBy="statuttexte")
    */
    private $textesjuridiques;
    
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\Constitution",mappedBy="statuttexte")
    */
    private $constitutions;
    
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
     * @ORM\Column(name="StatutTexte", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $statutTexte;


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
     * Set statutTexte
     *
     * @param string $statutTexte
     *
     * @return StatutTexte
     */
    public function setStatutTexte($statutTexte)
    {
        $this->statutTexte = $statutTexte;

        return $this;
    }

    /**
     * Get statutTexte
     *
     * @return string
     */
    public function getStatutTexte()
    {
        return $this->statutTexte;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->textesjuridiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add textesjuridique
     *
     * @param \Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique
     *
     * @return StatutTexte
     */
    public function addTextesjuridique(\Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique)
    {
        $this->textesjuridiques[] = $textesjuridique;
        $textesjuridiques->setStatutTexte($this);
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

    /**
     * Add constitution
     *
     * @param \Culture\JuridiqueBundle\Entity\Constitution $constitution
     *
     * @return StatutTexte
     */
    public function addConstitution(\Culture\JuridiqueBundle\Entity\Constitution $constitution)
    {
        $this->constitutions[] = $constitution;

        return $this;
    }

    /**
     * Remove constitution
     *
     * @param \Culture\JuridiqueBundle\Entity\Constitution $constitution
     */
    public function removeConstitution(\Culture\JuridiqueBundle\Entity\Constitution $constitution)
    {
        $this->constitutions->removeElement($constitution);
    }

    /**
     * Get constitutions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConstitutions()
    {
        return $this->constitutions;
    }
}
