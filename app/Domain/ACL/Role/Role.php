<?php

namespace App\Domain\ACL\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use LaravelDoctrine\ACL\Contracts\Role as RoleContract;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use App\Domain\ACL\Contracts\HasModules;
use App\Domain\ACL\Module\Module;
use App\Domain\ACL\Permission\Permission;
use App\Domain\Core\Model;

/**
 * @ORM\Entity
 */
class Role extends Model implements RoleContract, HasModules
{

    use Timestamps;

    const SUPER_ADMIN = 'super-admin';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\ACL\Module\Module", inversedBy="roles")
     * @ORM\JoinTable(name="roles_modules")
     */
    protected $modules;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\ACL\Permission\Permission")
     * @ORM\JoinTable(name="permission_role",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="id")}
     *      )
     */
    public $permissions;

    public function __construct()
    {
        $this->modules = new ArrayCollection;
        $this->permissions = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function assignPermission(Permission $permission)
    {
        if (! $this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }
    }

    public function assignModule(Module $module)
    {
        if (! $this->modules->contains($module)) {
            $this->modules->add($module);
        }
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function hasPermissionTo($permission)
    {
        foreach ($this->permissions as $permission) {
            if ($permission->getName() == $permission) {
                return true;
            }
        }

        return false;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function isSuperAdmin()
    {
        return $this->getName() == static::SUPER_ADMIN;
    }

}