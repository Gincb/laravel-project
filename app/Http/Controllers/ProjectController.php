<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Objective;
use App\Project;
use App\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{

    const COVER_DIRECTORY = 'projects';

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $projects = Project::all();

        return view('project.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $teams = Team::all();
        $objectives = Objective::all();

        return view('project.create', compact('teams', 'objectives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectStoreRequest $request
     * @return RedirectResponse
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

        Project::create($data);


        return redirect()
            ->route('project.index')
            ->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function show(Project $project): View
    {
        $team = Team::all();
        $objective = Objective::all();

        return view('project.view', compact('project', 'team', 'objective'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function edit(Project $project): View
    {
        $teams = Team::all();
        $objectives = Objective::all();

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
