<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compteur
 *
 * @ORM\Table(name="compteur")
 * @ORM\Entity(repositoryClass="Culture\JuridiqueBundle\Repository\CompteurRepository")
 */
class Compteur {

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
     * @ORM\Column(name="compteur", type="integer")
     */
    private $compteur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
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

    public function increaseCompteur() {
        $this->compteur++;
    }

    

}
