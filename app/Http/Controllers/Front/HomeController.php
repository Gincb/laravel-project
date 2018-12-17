<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;

class HomeController extends Controller
{
    /** @var ProjectRepository */
    private $projectRepository;

    /**
     * HomeController constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $projects = $this->projectRepository->makeQuery()
            ->with('teams')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('projects'));
    }
}
