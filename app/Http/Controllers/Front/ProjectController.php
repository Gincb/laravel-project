<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Front;

use App\Repositories\ProjectRepository;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ProjectController
 * @package App\Http\Controllers\Front
 */
class ProjectController extends Controller
{
    /** @var ProjectRepository */
    private $projectRepository;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Exception
     */
    public function index(): View
    {
        $projects = $this->projectRepository->paginate(6, ['*']);

        return view('front.projects', compact('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return View
     * @throws \Exception
     */
    public function show(string $slug): View
    {
        $project = $this->projectRepository->getBySlug($slug);

        return view('front.project', compact('project'));
    }
}
