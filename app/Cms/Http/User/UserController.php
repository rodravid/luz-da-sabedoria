<?php

namespace App\Cms\Http\User;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Flash;
use Illuminate\Http\Request;
use Redirect;
use App\Cms\Http\Controller;
use App\Core\Services\Datatables\DatatablesResponse;
use App\Core\Services\Validation\Exceptions\ValidationException;
use App\Domain\ACL\Role\RoleRepository;
use App\Domain\Admin\AdminRepository;
use App\Domain\Admin\AdminService;

class UserController extends Controller
{

    use DatatablesResponse;

    protected $adminService;

    protected $adminRepository;

    protected $datatable = 'Vinci\Infrastructure\Admin\Datatables\UsersCmsDatatable';

    protected $roleRepository;

    public function __construct(
        EntityManagerInterface $em,
        AdminService $adminService,
        AdminRepository $adminRepository,
        RoleRepository $roleRepository
    )
    {
        parent::__construct($em);

        $this->adminService = $adminService;
        $this->adminRepository = $adminRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return $this->view('users.list');
    }

    public function create()
    {
        $roles = $this->getRolesSelectArray();

        return $this->view('users.create')->withRoles($roles);
    }

    public function edit($id)
    {
        $user = $this->adminRepository->findOrFail($id);
        $roles = $this->roleRepository->getAll();

        return $this->view('users.edit')
            ->withUser($user)
            ->withRoles($roles);
    }

    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $user = $this->adminService->create($data);

            Flash::success("Usuário {$user->getName()} criado com sucesso!");

            return Redirect::route('cms.users.edit', $user->getId());

        } catch (ValidationException $e) {

            return Redirect::back()->withErrors($e->getErrors())->withInput();

        } catch (Exception $e) {

            Flash::error($e->getMessage());

            return Redirect::back()->withInput();
        }
    }

    public function update(Request $request, $customerId)
    {
        try {

            $data = $request->all();

            $user = $this->adminService->update($data, $customerId);

            Flash::success("Usuário {$user->getName()} atualizado com sucesso!");

            return Redirect::route('cms.users.edit', $user->getId());

        } catch (ValidationException $e) {

            return Redirect::back()->withErrors($e->getErrors())->withInput();

        } catch (Exception $e) {

            Flash::error($e->getMessage());

            return Redirect::back()->withInput();
        }

    }

    public function destroy($userId)
    {
        $user = $this->adminRepository->find($userId);

        try {

            $this->adminRepository->delete($user);

            Flash::success("Usuário {$user->getName()} excluído com sucesso!");

            return Redirect::route('cms.users.list');

        } catch (Exception $e) {

            Flash::error($e->getMessage());
            return Redirect::back();
        }
    }

    protected function getRolesSelectArray()
    {
        $roles = $this->roleRepository->getAll();
        return html_select_array($roles);
    }

}