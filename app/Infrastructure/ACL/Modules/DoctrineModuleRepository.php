<?php

namespace App\Infrastructure\ACL\Modules;

use Doctrine\Common\Collections\Collection;
use App\Domain\ACL\Module\Module;
use App\Domain\ACL\Module\ModuleRepository;
use App\Infrastructure\Common\DoctrineNestedTreeRepository;

class DoctrineModuleRepository extends DoctrineNestedTreeRepository implements ModuleRepository
{

    public function getAll()
    {
        $query = $this->_em
            ->createQueryBuilder()
            ->select('module', 'r', 'p')
            ->from('App\Domain\ACL\Module\Module', 'module')
            ->leftJoin('module.roles', 'r')
            ->leftJoin('r.permissions', 'p')
            ->orderBy('module.root, module.lft', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    public function getFromRoles(Collection $roles)
    {
        $query = $this->_em
            ->createQueryBuilder()
            ->select('module', 'r', 'p')
            ->from('App\Domain\ACL\Module\Module', 'module')
            ->join('module.roles', 'r')
            ->join('r.permissions', 'p')
            ->orderBy('module.root, module.lft', 'ASC')
            ->where('r.id in (:ids)')
            ->getQuery();

        $ids = $roles->map(function($role) {
            return $role->getId();
        });

        $query->setParameter('ids', $ids);

        return $query->getResult();
    }

    public function findByName($name)
    {
        $query = $this->_em
            ->createQueryBuilder()
            ->select('m', 'r', 'p')
            ->from('App\Domain\ACL\Module\Module', 'm')
            ->join('m.roles', 'r')
            ->join('r.permissions', 'p')
            ->where('m.name = :name')
            ->getQuery();

        $query->setParameter('name', $name);

        return $query->getOneOrNullResult();
    }

    public function findByPermissionName($name)
    {
        return $this->findByName($name);
    }

    public function buildTree(array $modules, array $options = [])
    {
        $normalized = [];

        foreach ($modules as $module) {
            $normalized[] = $this->normalizeModule($module);
        }

        return parent::buildTree($normalized, $options);
    }

    protected function normalizeModule($module)
    {
        if (is_array($module)) {
            return $module;
        }

        return [
            'id' => $module->getId(),
            'name' => $module->getName(),
            'title' => $module->getTitle(),
            'url' => $module->getUrl(),
            'icon' => $module->getIcon(),
            'lvl' => $module->getLvl(),
            'lft' => $module->getLft(),
            'rgt' => $module->getRgt()
        ];

    }

    public function add($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

}