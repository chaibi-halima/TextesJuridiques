<?php

namespace Culture\JuridiqueBundle\Entity\Traduction;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="cahier_chargetraduction", indexes={
 *      @ORM\Index(name="cahier_chargeTraduction_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class CahierChargeTraduction extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}