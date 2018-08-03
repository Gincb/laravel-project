<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
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
        $categories = Category::all();

        return view('project.create', compact('categories'));
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
            'description' => $request->getDescription(),
            'slug' => $request->getSlug(),
        ];

        $project = Project::create($data);

        $project->categories()->attach($request->getCategoriesIds());


        return redirect()->route('project.index')->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function show(Project $project): View
    {
        return view('project.view', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function edit(Project $project): View
    {
        $categories = Category::all();

        return view('project.edit', compact('project', 'categories'));
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
        $project->slug = $request->getSlug();

        $project->categories()->sync($request->getCategoriesIds());

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
