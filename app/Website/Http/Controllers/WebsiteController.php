<?php

namespace App\Website\Http\Controllers;

use App\Domain\Project\ProjectRepository;

class WebsiteController extends \App\Core\Http\Controllers\Controller
{
    protected $viewNamespace = 'website';
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        $projects = $this->projectRepository->getAllAvailable();
        return $this->view('home', compact('projects'));
    }
}