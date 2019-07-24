<?php

namespace Culture\JuridiqueBundle\Entity\Traduction;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="directiontraduction", indexes={
 *      @ORM\Index(name="directionTraduction_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class DirectionTraduction extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}