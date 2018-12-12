<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $plans = Plan::all();

        return view('plan.list', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlanRequest $request
     * @return RedirectResponse
     */
    public function store(PlanRequest $request): RedirectResponse
    {
        Plan::create([
            'task' => $request->getTask(),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Plan $plan
     * @return View
     */
    public function edit(Plan $plan): View
    {
        return view('plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PlanRequest $request
     * @param Plan $plan
     * @return RedirectResponse
     */
    public function update(PlanRequest $request, Plan $plan): RedirectResponse
    {
        $plan->task = $request->getTask();

        $plan->save();

        return redirect()
            ->route('objective.index')
            ->with('status', 'Plan updated successfully!');
    }

}
