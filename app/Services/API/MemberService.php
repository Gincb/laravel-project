<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\MemberException;
use App\Member;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class MemberService
 * @package App\Services\API
 */
class MemberService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1)
    {
        /** @var LengthAwarePaginator $member */
        $members = Member::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($members->isEmpty()) {
            throw MemberException::noData();
        }

        return $members;
    }

    /**
     * @param int $memberId
     * @return Member
     */
    public function getById(int $memberId): Member
    {
        return Member::findOrFail($memberId);
    }
}