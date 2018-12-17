<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\MemberException;
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
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $member */
        $members = $this->memberRepository->paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($members->isEmpty()) {
            throw MemberException::noData();
        }

        return $members;
    }

    /**
     * @param int $memberId
     * @return Model
     * @throws \Exception
     */
    public function getById(int $memberId): Model
    {
        return $this->memberRepository->findOrFail($memberId);
    }
}