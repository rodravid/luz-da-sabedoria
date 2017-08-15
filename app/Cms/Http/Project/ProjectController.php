<?php

namespace App\Cms\Http\Project;

use App\Cms\Http\Controller;
use App\Core\Services\Datatables\DatatablesResponse;
use App\Core\Services\Validation\Exceptions\ValidationException;
use App\Domain\Image\ImageService;
use App\Domain\Project\ProjectRepository;
use App\Domain\Project\ProjectService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class ProjectController extends Controller
{

    use DatatablesResponse;

    protected $service;

    protected $repository;

    protected $datatable = 'App\Infrastructure\Project\Datatables\ProjectCmsDatatable';

    private $imageService;

    public function __construct(ProjectRepository $repository, ProjectService $service, ImageService $imageService)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->imageService = $imageService;
    }

    public function index()
    {
        return $this->view('projects.list');
    }

    public function create()
    {
        return $this->view('projects.create');
    }

    public function edit($id)
    {
        $project = $this->repository->findOrFail($id);

        return $this->view('projects.edit', compact('project'));
    }

    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $project = $this->service->create($data);

            Flash::success("Projeto {$project->getTitle()} criado com sucesso!");

            return Redirect::route($this->getEditRouteName(), $project->getId());

        } catch (ValidationException $e) {

            return Redirect::back()->withErrors($e->getErrors())->withInput();

        } catch (Exception $e) {

            Flash::error($e->getMessage());

            return Redirect::back()->withInput();
        }
    }

    public function update(Request $request, $projectId)
    {
        try {

            $data = $request->all();

            $project = $this->service->update($data, $projectId);

            Flash::success("Projeto {$project->getTitle()} atualizado com sucesso!");

            return Redirect::route($this->getEditRouteName(), $project->getId())
                ->withInput(['current-tab' => $request->get('current-tab')]);

        } catch (ValidationException $e) {

            return Redirect::back()->withErrors($e->getErrors())->withInput();

        } catch (Exception $e) {

            Flash::error($e->getMessage());

            return Redirect::back()->withInput();
        }

    }

    public function destroy($customerId)
    {
        $project = $this->repository->find($customerId);

        try {

            $this->repository->delete($project);

            Flash::success("Projeto {$project->getName()} excluído com sucesso!");

            return Redirect::route($this->getListRouteName());

        } catch (Exception $e) {

            Flash::error($e->getMessage());
            return Redirect::back();
        }
    }

    public function removeBanner($project)
    {
        try {

            $project = $this->repository->findOrFail($project);

            $this->imageService->removeFrom($project, $project->getBanner());

            $this->repository->save($project);

            Flash::success("Banner excluído com sucesso!");

            return Redirect::back();

        } catch (Exception $e) {

            Flash::error($e->getMessage());
            return Redirect::back();
        }

    }

}