<?php

namespace App\Domain\ACL\Permission;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Contracts\Permission as PermissionContract;
use App\Domain\Core\Model;

/**
 * @ORM\Entity
 */
class Permission extends Model implements PermissionContract
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function extractModuleName()
    {
        return $this->getSegments(1);
    }

    public function extractActionName()
    {
        $segments = $this->getSegments();
        return end($segments);
    }

    public function canBeListed()
    {
        return $this->extractActionName() != 'list';
    }

    public function getSegments($offset = null)
    {
        $segments =  explode('.', $this->name);

        if(isset($segments[$offset])) {
            return $segments[$offset];
        }

        return $segments;
    }

}
