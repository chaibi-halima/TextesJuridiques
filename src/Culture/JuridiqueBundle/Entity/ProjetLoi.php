<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * ProjetLoi
 *
 * @ORM\Table(name="projet_loi")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\ProjetLoiRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\ProjetLoiTraduction")
 */
class ProjetLoi
{
    /**
    * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\PhaseProjet",inversedBy="textesjuridiques")
    * @ORM\JoinColumn(nullable=false)
    */
    private $phaseprojet;
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
     * @ORM\Column(name="sujet", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $sujet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

     /**
     * @var text
     *
     * @ORM\Column(name="contenu", type="text")
     * @Gedmo\Translatable
     */
    private $contenu;
    
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
     * Set sujet
     *
     * @param string $sujet
     *
     * @return ProjetLoi
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ProjetLoi
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
     * Set phaseprojet
     *
     * @param \Culture\JuridiqueBundle\Entity\PhaseProjet $phaseprojet
     *
     * @return ProjetLoi
     */
    public function setPhaseprojet(\Culture\JuridiqueBundle\Entity\PhaseProjet $phaseprojet)
    {
        $this->phaseprojet = $phaseprojet;

        return $this;
    }

    /**
     * Get phaseprojet
     *
     * @return \Culture\JuridiqueBundle\Entity\PhaseProjet
     */
    public function getPhaseprojet()
    {
        return $this->phaseprojet;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return ProjetLoi
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

    /**
     * Set brochure
     *
     * @param string $brochure
     *
     * @return ProjetLoi
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
}
