<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Constitution
 *
 * @ORM\Table(name="constitution")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\ConstitutionRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\ConstitutionTraduction")
 */
class Constitution
{
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
    * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\StatutTexte",inversedBy="constitutions")
    * @ORM\JoinColumn(nullable=false)
    */
    private $statuttexte;
    
    /**
     * @var text
     *
     * @ORM\Column(name="contenu", type="text")
     * @Gedmo\Translatable
     * 
     */
    private $contenu;
    
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
     * @return Constitution
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Constitution
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
     * @return Constitution
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
     * Set statuttexte
     *
     * @param \Culture\JuridiqueBundle\Entity\StatutTexte $statuttexte
     *
     * @return Constitution
     */
    public function setStatuttexte(\Culture\JuridiqueBundle\Entity\StatutTexte $statuttexte)
    {
        $this->statuttexte = $statuttexte;

        return $this;
    }

    /**
     * Get statuttexte
     *
     * @return \Culture\JuridiqueBundle\Entity\StatutTexte
     */
    public function getStatuttexte()
    {
        return $this->statuttexte;
    }
    
    

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Constitution
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}
