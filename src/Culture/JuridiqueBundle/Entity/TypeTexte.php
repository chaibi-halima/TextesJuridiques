<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * TypeTexte
 *
 * @ORM\Table(name="type_texte")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\TypeTexteRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\TypeTexteTraduction")
 */
class TypeTexte
{
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
     * @ORM\Column(name="TypeTexte", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $typeTexte;


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
     * Set typeTexte
     *
     * @param string $typeTexte
     *
     * @return TypeTexte
     */
    public function setTypeTexte($typeTexte)
    {
        $this->typeTexte = $typeTexte;

        return $this;
    }

    /**
     * Get typeTexte
     *
     * @return string
     */
    public function getTypeTexte()
    {
        return $this->typeTexte;
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
     * @return TypeTexte
     */
    public function addTextesjuridique(\Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique)
    {
        $this->textesjuridiques[] = $textesjuridique;
        $textesjuridiques->setTypeTexte($this);
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
