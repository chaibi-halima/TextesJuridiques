<?php

namespace Culture\JuridiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Documents
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Documents {

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
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;
    public $file;

    /**
     * @ORM\OneToMany(targetEntity="MyEntity", mappedBy="images")
     */
    protected $myentity;

    public function __construct($path = "") {
        $this->myentity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setPath($path);
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        if (null !== $this->file) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->name = $filename . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->file)
            return;
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir() . $this->path, $this->name);
            unset($this->file);
            //if($this->oldFile != null)
            //     unlink($this->tempFile);    
        }
    }

    /**
     *  @ORM\PostLoad()
     */
    public function postLoad() {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        // if($file = $this->getAbsolutePath())
        //     unlink($file);
        if (file_exists($this->tempFile))
            unlink($this->tempFile);
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    public function getAssetPath() {
        return $this->getUploadDir() . $this->path;
    }

    /**
     * Called after entity persistence
     *
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . $this->path;
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Documents
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Documents
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Add myentity
     *
     * @param \Culture\JuridiqueBundle\Entity\MyEntity $myentity
     * @return Documents
     */
    public function addMyentity(\Culture\JuridiqueBundle\Entity\MyEntity $myentity) {
        $this->myentity[] = $myentity;

        return $this;
    }

    /**
     * Remove myentity
     *
     * @param \Culture\JuridiqueBundle\Entity\MyEntity $myentity
     */
    public function removeMyentity(\Culture\JuridiqueBundle\Entity\MyEntity $myentity) {
        $this->myentity->removeElement($myentity);
    }

    /**
     * Get myentity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyentity() {
        return $this->myentity;
    }

    /**
     * @return File
     */
    public function getFile() {
        return $this->file;
    }

}
