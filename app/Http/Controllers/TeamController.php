<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Member;
use App\Team;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Compound;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $teams = Team::all();

        return view('team.list', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $members = Member::all();
        return view('team.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TeamStoreRequest $request): RedirectResponse
    {
        $team = Team::create([
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
        ]);

        $team->members()->attach($request->getMembersIds());

        return redirect()
            ->route('team.index')
            ->with('status', 'Team created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return View
     */
    public function show(Team $team): View
    {
        return view('team.view', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return View
     */
    public function edit(Team $team): View
    {
        $members = Member::all();

        return view('team.edit', compact('team', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeamUpdateRequest $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(TeamUpdateRequest $request, Team $team): RedirectResponse
    {
        $team->title = $request->getTitle();
        $team->slug = $request->getSlug();

        $team->members()->sync($request->getMembersIds());

        $team->save();

        return redirect()
            ->route('team.index')
            ->with('status', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Team $team): RedirectResponse
    {
        $team->delete();

        return redirect()
            ->route('team.index')
            ->with('status', 'team delete successfully!');
    }
}
