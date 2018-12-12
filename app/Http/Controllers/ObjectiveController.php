<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\ObjectiveStoreRequest;
use App\Http\Requests\ObjectiveUpdateRequest;
use App\Objective;
use App\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $objectives = Objective::all();

        return view('objective.list', compact('objectives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $plans = Plan::all();

        return view('objective.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ObjectiveStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ObjectiveStoreRequest $request): RedirectResponse
    {
        $objective = Objective::create([
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
        ]);

        $objective->plans()->attach($request->getPlansIds());

        return redirect()
            ->route('objective.index')
            ->with('status', 'Objective created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Objective $objective
     * @return View
     */
    public function show(Objective $objective): View
    {
        return view('objective.view', compact('objective'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Objective $objective
     * @return View
     */
    public function edit(Objective $objective): View
    {
        $plans = Plan::all();

        return view('objective.edit', compact('objective', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ObjectiveUpdateRequest $request
     * @param Objective $objective
     * @return RedirectResponse
     */
    public function update(ObjectiveUpdateRequest $request, Objective $objective): RedirectResponse
    {
        $objective->title = $request->getTitle();
        $objective->slug = $request->getSlug();

        $objective->plans()->sync($request->getPlansIds());

        $objective->save();

        return redirect()
            ->route('objective.index')
            ->with('status', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Objective $objective
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Objective $objective): RedirectResponse
    {
        $objective->delete();

        return redirect()
            ->route('objective.index')
            ->with('status', 'Objective deleted successfully!');
    }
}
