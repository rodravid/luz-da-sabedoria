<?php

namespace App\Domain\ACL;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\ACL\Module\Module;
use App\Domain\ACL\Module\ModuleRepository;
use App\Domain\ACL\Permission\Permission;
use App\Domain\ACL\Permission\PermissionRepository;
use App\Domain\ACL\Role\Role;
use App\Domain\ACL\Role\RoleRepository;
use App\Domain\User\User;

class ACLService
{
    protected $moduleRepository;

    protected $permissionRepository;

    protected $currentModule;

    protected $entityManager;

    protected $roleRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ModuleRepository $moduleRepository,
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->moduleRepository = $moduleRepository;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function setCurrentModule(Module $module)
    {
        $this->currentModule = $module;
    }

    public function getCurrentModule()
    {
        return $this->currentModule;
    }

    public function getCurrentModuleName()
    {
        return $this->currentModule->getName();
    }

    public function getCurrentModuleId()
    {
        return $this->currentModule->getId();
    }

    public function buildModulesTreeHtmlForUser(User $user, array $options = [])
    {
        $modules = $this->getModulesForUser($user);

        return $this->moduleRepository->buildTree($modules, $options);
    }

    protected function getModulesForUser(User $user)
    {
        if ($user->isSuperAdmin()) {
            return $this->moduleRepository->getAll();
        }

        return $this->moduleRepository->getFromRoles($user->getRoles());
    }

    public function userCanAccessRoute(User $user, $routeName)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        $permissionName = $this->normalizePermissionName($routeName);

        $permission = $this->permissionRepository->findByName($permissionName);

        if ($this->currentModule && $this->currentModule->canBeManagedBy($user)) {

            if ($permission->extractActionName() == 'list') {
                return true;
            }

            return $user->hasPermissionTo($permissionName);
        }

        return false;
    }

    public function findModuleByPermissionName($permissionName)
    {
        $permissionName = $this->normalizePermissionName($permissionName);

        $moduleName = Permission::make()->setName($permissionName)->extractModuleName();

        return $this->moduleRepository->findByName($moduleName);
    }

    protected function normalizePermissionName($name)
    {
        return explode('#', $name)[0];
    }

    public function getAllPermissionsGroupedByModule()
    {
        $permissions = $this->permissionRepository->getAll();

        return $this->groupPermissionsByModule($permissions);
    }

    public function getPermissionsByUserGroupedByModule(User $user)
    {

        return $this->groupPermissionsByModule($user->getPermissions());

    }

    protected function groupPermissionsByModule($permissions)
    {

        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            $module = $this->moduleRepository->findByName($permission->extractModuleName());

            $groupedPermissions[$module->getName()]['module'] = $module;
            $groupedPermissions[$module->getName()]['permissions'][] = $permission;
        }

        return $groupedPermissions;
    }

    public function createRole(array $attributes)
    {
        $role = Role::make([
            'title' => $attributes['title'],
            'description' => $attributes['description']
        ]);

        $this->assignPermissions($role, $attributes['permissions']);

        $this->assignModules($role, $attributes['modules']);

        $this->roleRepository->save($role);

        return $role;
    }

    public function updateRole(array $attributes, $id)
    {
        $role = $this->roleRepository->find($id);

        $role->getModules()->clear();

        $role->getPermissions()->clear();

        $this->assignPermissions($role, $attributes['permissions']);

        $this->assignModules($role, $attributes['modules']);

        $this->roleRepository->save($role);

        return $role;
    }

    protected function assignPermissions($role, $permissions = [])
    {
        foreach($permissions as $permission) {
            $role->assignPermission($this->entityManager->getReference(Permission::class, $permission));
        }
    }

    protected function assignModules(Role $role, array $modules = [])
    {
        foreach($modules as $moduleId) {

            $module = $this->moduleRepository->find($moduleId);

            $role->assignModule($module);

            if ($module->hasParent()) {
                $this->assignModules($role, [$module->getParent()->getId()]);
            }

        }
    }

}