<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Member;
use App\Repositories\MemberRepository;
use App\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class MemberController
 * @package App\Http\Controllers
 */
class MemberController extends Controller
{
    /**
     *
     */
    const PHOTO_DIRECTORY = 'members';

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * MemberController constructor.
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Exception
     */
    public function index(): View
    {
        $members = $this->memberRepository->all();

        return view('member.list', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MemberRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(MemberRequest $request): RedirectResponse
    {
        $this->memberRepository->create([
            'photo' => $request->getPhoto() ? $request->getPhoto()->store(self::PHOTO_DIRECTORY) : null,
            'first_name' => $request->getFirstName(),
            'last_name' => $request->getLastName(),
            'position' => $request->getPosition(),
        ]);

        return redirect()->route('member.index')->with('status', 'Member added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Member $member
     * @return View
     */
    public function edit(Member $member): View
    {
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MemberRequest $request
     * @param Member $member
     * @return RedirectResponse
     */
    public function update(MemberRequest $request, Member $member): RedirectResponse
    {
        $member->first_name = $request->getFirstName();
        $member->last_name = $request->getLastName();
        $member->position = $request->getPosition();

        if($request->getPhoto()){
            $member->photo = $request->getPhoto()->store(self::PHOTO_DIRECTORY);
        }

        $member->save();

        return redirect()->route('member.index')->with('status', 'Member added successfully!');
    }

}
