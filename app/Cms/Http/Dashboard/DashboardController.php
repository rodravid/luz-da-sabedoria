<?php

namespace App\Cms\Http\Dashboard;

use App\Cms\Http\Controller;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends Controller
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index()
    {
        $numberOfProjects = array_first($this->em->createQuery('SELECT COUNT(p.id) FROM App\Domain\Project\Project p')->getOneOrNullResult());

        return $this->view('dashboard.index', compact('numberOfProjects'));
    }

}