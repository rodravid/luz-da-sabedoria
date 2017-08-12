<?php

namespace App\Infrastructure\ACL\Modules;

use Doctrine\Common\Collections\Collection;
use App\Domain\ACL\Module\ModuleRepository;
use App\Infrastructure\Cache\Traits\ArrayCache;

class DoctrineModuleRepositoryCached extends DoctrineModuleRepository implements ModuleRepository
{

    use ArrayCache;

    public function getAll()
    {
        return $this->cache('all', function() {
            return parent::getAll();
        });
    }

    public function getFromRoles(Collection $roles)
    {
        return $this->cache('from_roles' . md5(serialize($roles->toArray())), function() use($roles) {

            $modules = [];

            foreach($this->getAll() as $module) {

                $intersected = array_uintersect($roles->toArray(), $module->getRoles()->toArray(), function($role1, $role2) {
                    return strcmp($role1->getName(), $role2->getName());
                });

                if (count($intersected)) {
                    $modules[] = $module;
                }

            }

            return $modules;
        });
    }

    public function findByName($name)
    {
        return $this->cache('by_name' . $name, function() use($name) {
            foreach ($this->getAll() as $module) {
                if ($module->getName() == $name) {
                    return $module;
                }
            }
        });
    }

    public function find($id)
    {
        return $this->cache('by_id' . $id, function() use($id) {
            foreach ($this->getAll() as $module) {
                if ($module->getId() == $id) {
                    return $module;
                }
            }
        });
    }

}