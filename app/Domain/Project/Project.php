<?php

namespace App\Domain\Project;

use App\Domain\Core\Model;
use App\Domain\Image\Image;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use LaravelDoctrine\Extensions\SoftDeletes\SoftDeletes;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Project extends Model
{
    use Timestamps, SoftDeletes;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    /**
     * @ORM\Column(name="subtitle", type="string", nullable=true)
     */
    protected $subtitle;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="smallint", options={"default" = 0})
     */
    protected $status = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Image\Image")
     */
    protected $banner;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getBanner()
    {
        return $this->banner;
    }

    public function setBanner(Image $banner)
    {
        $this->banner = $banner;
        return $this;
    }

    public function hasBanner()
    {
        return $this->banner instanceof Image;
    }

    public function removeImage()
    {
        $this->banner = null;
    }

    public function getImagesUploadPath()
    {
        return 'projects/' . $this->getId() . '/images';
    }

}