<?php

namespace Culture\JuridiqueBundle\Entity\Traduction;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="sous_categorie2traduction", indexes={
 *      @ORM\Index(name="sous_categorie2Traduction_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class SousCategorie2Traduction extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}