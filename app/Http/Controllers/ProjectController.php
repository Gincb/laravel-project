<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Objective;
use App\Project;
use App\Repositories\ObjectiveRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TeamRepository;
use App\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     *
     */
    const COVER_DIRECTORY = 'projects';

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var ObjectiveRepository
     */
    private $objectiveRepository;

    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $projectRepository
     * @param ObjectiveRepository $objectiveRepository
     * @param TeamRepository $teamRepository
     */
    public function __construct(ProjectRepository $projectRepository, ObjectiveRepository $objectiveRepository, TeamRepository $teamRepository)
    {
        $this->middleware('auth');
        $this->projectRepository = $projectRepository;
        $this->objectiveRepository = $objectiveRepository;
        $this->teamRepository = $teamRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Exception
     */
    public function index(): View
    {
        $projects = $this->projectRepository->paginate();

        return view('project.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws \Exception
     */
    public function create(): View
    {
        $teams = $this->teamRepository->all();
        $objectives = $this->objectiveRepository->all();

        return view('project.create', compact('teams', 'objectives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectStoreRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(ProjectStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
            'description' => $request->getDescription(),
            'team_id' => $request->getTeamId(),
            'objective_id' => $request->getObjectiveId(),
            'slug' => $request->getSlug(),
        ];

        $this->projectRepository->create($data);


        return redirect()
            ->route('project.index')
            ->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return View
     * @throws \Exception
     */
    public function show(Project $project): View
    {
        $team = $this->teamRepository->all();
        $objective = $this->objectiveRepository->all();

        return view('project.view', compact('project', 'team', 'objective'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return View
     * @throws \Exception
     */
    public function edit(Project $project): View
    {
        $teams = $this->teamRepository->all();
        $objectives = $this->objectiveRepository->all();

        return view('project.edit', compact('project', 'teams', 'objectives'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectUpdateRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function update(ProjectUpdateRequest $request, Project $project): RedirectResponse
    {
        $project->title = $request->getTitle();
        $project->description = $request->getDescription();
        $project->team_id = $request->getTeamId();
        $project->objective_id = $request->getObjectiveId();
        $project->slug = $request->getSlug();

        if($request->getCover()){
            $project->cover = $request->getCover()->store(self::COVER_DIRECTORY);
        }

        $project->save();

        return redirect()->route('project.index')->with('status', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('project.index')->with('status', 'Project deleted successfully!');
    }
}
