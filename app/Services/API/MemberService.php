<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\MemberException;
use App\Member;
use App\Repositories\MemberRepository;
use App\Services\ApiService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberService
 * @package App\Services\API
 */
class MemberService extends ApiService
{

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * MemberService constructor.
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData()
    {
        /** @var LengthAwarePaginator $member */
        $members = $this->memberRepository->paginate();

        if ($members->isEmpty()) {
            throw MemberException::noData();
        }

        return $members;
    }

    /**
     * @param int $memberId
     * @return Member|Model
     * @throws \Exception
     */
    public function getById(int $memberId)
    {
        return $this->memberRepository->findOrFail($memberId);
    }
}