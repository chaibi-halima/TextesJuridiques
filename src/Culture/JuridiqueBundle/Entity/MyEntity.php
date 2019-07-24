<?php
namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Culture\JuridiqueBundle\Entity\Documents;

/**
 * MyEntity
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class MyEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


   

    /**
     * @ORM\ManyToOne(targetEntity="Documents", cascade={"persist", "remove"}, inversedBy="myentity")
     * @ORM\JoinColumn(name="logo", referencedColumnName="id", nullable=true)
     */
    private $logo = null;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Documents", inversedBy="myentity")
     * @ORM\JoinColumn(name="images", referencedColumnName="id", nullable=true)
     */
    protected $images = null;

    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return MyEntity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

   

    /**
     * Set images
     *
     * @param \Culture\JuridiqueBundle\Entity\Documents $images
     * @return MyEntity
     */
    public function setImages(\Culture\JuridiqueBundle\Entity\Documents $images = null)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return \Culture\JuridiqueBundle\Entity\Documents 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return MyEntity
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set logo
     *
     * @param \Culture\JuridiqueBundle\Entity\Documents $logo
     * @return MyEntity
     */
    public function setLogo(\Culture\JuridiqueBundle\Entity\Documents $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \Culture\JuridiqueBundle\Entity\Documents 
     */
    public function getLogo()
    {
        return $this->logo;
    }
}