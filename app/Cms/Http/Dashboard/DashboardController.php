<?php

namespace App\Cms\Http\Dashboard;

use App\Cms\Http\Controller;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends Controller
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public function index()
    {
        return $this->view('dashboard.index');
    }

}