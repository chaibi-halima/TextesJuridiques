<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 *
 * @ORM\Table(name="jort")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\jortRepository")
 */
class jort
{
    /**
    * @ORM\OneToMany(targetEntity="Culture\JuridiqueBundle\Entity\TexteJuridique",mappedBy="numero")
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
     * @ORM\Column(name="Numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

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
     * Set numero
     *
     * @param string $numero
     *
     * @return jort
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return jort
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
     * Set brochure
     *
     * @param string $brochure
     *
     * @return jort
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
     * @return Numero
     */
    public function addTextesjuridique(\Culture\JuridiqueBundle\Entity\TexteJuridique $textesjuridique)
    {
        $this->textesjuridiques[] = $textesjuridique;
        $textesjuridiques->setjort($this);
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
