<?php

namespace App\Domain\Project;

use App\Domain\Core\Model;
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
     * @ORM\Column(name="subtitle", type="string")
     */
    protected $subtitle;

    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="smallint", options={"default" = 0})
     */
    protected $status = 0;
}