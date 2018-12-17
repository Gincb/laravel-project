<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Front;

use App\Repositories\MemberRepository;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class MemberController
 * @package App\Http\Controllers\Front
 */
class MemberController extends Controller
{
    /** @var MemberRepository */
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
        $members = $this->memberRepository->paginate(20, ['*']);

        return view('front.members', compact('members'));
    }

}
