<?php

namespace App\Domain\Post;

use App\Domain\Core\Model;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use LaravelDoctrine\Extensions\SoftDeletes\SoftDeletes;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Post extends Model
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
     * @ORM\Column(name="content", type="text")
     */
    protected $content;
}