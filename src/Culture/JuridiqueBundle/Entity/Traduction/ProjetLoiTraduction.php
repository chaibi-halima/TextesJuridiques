<?php

namespace Culture\JuridiqueBundle\Entity\Traduction;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="projet_loitraduction", indexes={
 *      @ORM\Index(name="projet_loiTraduction_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class ProjetLoiTraduction extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}