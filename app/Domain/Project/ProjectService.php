<?php

namespace App\Domain\Project;

use App\Domain\Image\ImageService;
use Closure;
use Doctrine\ORM\EntityManagerInterface;

class ProjectService
{

    private $repository;
    private $imageService;
    private $em;

    public function __construct(EntityManagerInterface $em, ProjectRepository $repository, ImageService $imageService)
    {
        $this->repository = $repository;
        $this->imageService = $imageService;
        $this->em = $em;
    }

    public function create(array $data)
    {
        return $this->saveProject($data, function ($data) {
            return $project = Project::make($data);
        });
    }

    public function update($data, $projectId)
    {
        return $this->saveProject($data, function ($data) use ($projectId) {
            $project = $this->repository->findOrFail($projectId);

            $project
                ->setTitle(array_get($data, 'title'))
                ->setSubtitle(array_get($data, 'subtitle'))
                ->setDescription(array_get($data, 'description'))
                ->setStatus(array_get($data, 'status'));

            return $project;
        });
    }

    public function saveProject(array $data, Closure $method)
    {
        $project = $method($data);

        $banner = array_get($data, 'banner');

        unset($data['banner']);

        $this->repository->save($project);

        $this->saveBanner($project, $banner);

        $this->em->flush();

        return $project;
    }

    protected function saveBanner(Project $project, $image)
    {
        if (! empty($image)) {
            $banner = $this->imageService->storeFor($project, $image);

            $project->setBanner($banner);
        }

        $this->repository->save($project);
    }
}