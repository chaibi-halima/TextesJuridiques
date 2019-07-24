<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * TexteJuridique
 *
 * @ORM\Table(name="texte_juridique")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\TexteJuridiqueRepository")
 * @Gedmo\TranslationEntity(class="Culture\JuridiqueBundle\Entity\Traduction\TexteJuridiqueTraduction")
 * @ORM\HasLifecycleCallbacks()
 */
class TexteJuridique implements Translatable {

    /**
     * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\TypeTexte",inversedBy="textesjuridiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typetexte;

    /**
     * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\StatutTexte",inversedBy="textesjuridiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statuttexte;

    /**
     * @ORM\ManyToOne(targetEntity="Culture\JuridiqueBundle\Entity\Domaine",inversedBy="textesjuridiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domaine;

    public function __construct() {
        $this->typetexte = new \Doctrine\Common\Collections\ArrayCollection();
        $this->domaine = new \Doctrine\Common\Collections\ArrayCollection();
        $this->compteur = 0;
        $this->download = 0;

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
     * @ORM\Column(name="numero", type="string", length=255, nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="sujet", type="text")
     * @Gedmo\Translatable
     */
    private $sujet;

    /**
     * @var text
     *
     * @ORM\Column(name="contenu", type="text")
     * @Gedmo\Translatable
     */
    private $contenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nomination", type="boolean")
     */
    private $nomination;
    
     /**
     * @var string
     *
     * @ORM\Column(name="compteur", type="integer", nullable=true)
     * 
     */
    private $compteur;

     /**
     * @var string
     *
     * @ORM\Column(name="download", type="integer", nullable=true)
     * 
     */
    private $download;

     /**
     * @var string
     *
     * @ORM\Column(name="jort", type="string", length=255, nullable=true)
     * @Gedmo\Translatable
     */
    private $jort;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_jort", type="date", nullable=true)
     */
    private $date_jort;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * Set domaine
     *
     * 
     *
     * @return Domaine
     */
    public function setDomaine($domaine) {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return \Culture\JuridiqueBundle\Entity\Domaine
     */
    public function getDomaine() {
        return $this->domaine;
    }

    /**
     * Post locale
     * Used locale to override Translation listener's locale
     *
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * Sets translatable locale
     *
     * @param string $locale
     */
    public function setTranslatableLocale($locale) {
        $this->locale = $locale;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return TexteJuridique
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TexteJuridique
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set brochure
     *
     * @param string $brochure
     *
     * @return TexteJuridique
     */
    public function setBrochure($brochure) {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * Get brochure
     *
     * @return string
     */
    public function getBrochure() {
        return $this->brochure;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return TexteJuridique
     */
    public function setSujet($sujet) {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet() {
        return $this->sujet;
    }

    /**
     * Set typetexte
     *
     * 
     *
     * @return typetexte
     */
    public function setTypetexte($typetexte) {
        $this->typetexte = $typetexte;

        return $this;
    }

    /**
     * Get typetexte
     *
     * @return \Culture\JuridiqueBundle\Entity\TypeTexte
     */
    public function getTypetexte() {
        return $this->typetexte;
    }

    /**
     * Set statuttexte
     *
     * @param \Culture\JuridiqueBundle\Entity\StatutTexte $stauttexte
     *
     * @return TexteJuridique
     */
    public function setStatuttexte(\Culture\JuridiqueBundle\Entity\StatutTexte $statuttexte) {
        $this->statuttexte = $statuttexte;

        return $this;
    }

    /**
     * Get statuttexte
     *
     * @return \Culture\JuridiqueBundle\Entity\StatutTexte
     */
    public function getStatuttexte() {
        return $this->statuttexte;
    }

    /**
     * Set jort
     *
     * @param string $jort
     *
     * @return jort
     */
    public function setjort($jort) {
        $this->jort = $jort;

        return $this;
    }

    /**
     * Get jort
     *
     * @return \Culture\JuridiqueBundle\Entity\jort
     */
    public function getjort() {
        return $this->jort;
    }

    
    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return TexteJuridique
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set nomination
     *
     * @param integer $nomination
     *
     * @return TexteJuridique
     */
    public function setNomination($nomination) {
        $this->nomination = $nomination;

        return $this;
    }

    /**
     * Get nomination
     *
     * @return integer
     */
    public function getNomination() {
        return $this->nomination;
    }

    
     /**
     * Set compteur
     *
     * @param string $compteur
     *
     * @return Compteur
     */
    public function setCompteur($compteur) {
        $this->compteur = $compteur;

        return $this;
    }

    /**
     * Get compteur
     *
     * @return integer
     */
    public function getCompteur() {
        return $this->compteur;
    }
    /**
     * 
     *
     * @ORM\postLoad
     */
    public function increaseCompteur() {
        $this->compteur++;
    }
    
   


    /**
     * Set download
     *
     * @param integer $download
     *
     * @return TexteJuridique
     */
    public function setDownload($download)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return integer
     */
    public function getDownload()
    {
        return $this->download;
    }
    
    /**
     * 
     *
     * @ORM\postLoad
     */
    public function increaseDownload() {
        $this->download++;
    }

    /**
     * Set dateJort
     *
     * @param \DateTime $dateJort
     *
     * @return TexteJuridique
     */
    public function setDateJort($dateJort)
    {
        $this->date_jort = $dateJort;

        return $this;
    }

    /**
     * Get dateJort
     *
     * @return \DateTime
     */
    public function getDateJort()
    {
        return $this->date_jort;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return TexteJuridique
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }
}
