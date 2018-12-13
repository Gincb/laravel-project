<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Plan;
use App\Repositories\PlanRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PlanController
 * @package App\Http\Controllers
 */
class PlanController extends Controller
{
    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * PlanController constructor.
     * @param PlanRepository $planRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Exception
     */
    public function index(): View
    {
        $plans = $this->planRepository->all();

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
     * @throws \Exception
     */
    public function store(PlanRequest $request): RedirectResponse
    {
        $this->planRepository->create([
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
