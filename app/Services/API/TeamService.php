<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\TeamException;
use App\Services\ApiService;
use App\Team;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class TeamService
 * @package App\Services\API
 */
class TeamService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1)
    {
        /** @var LengthAwarePaginator $team */
        $teams = Team::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($teams->isEmpty()) {
            throw TeamException::noData();
        }

        return $teams;
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $teams */
        $teams = Team::with(['members'])->paginate(self::PER_PAGE, ['*'], 'page', $page);
        if ($teams->isEmpty()) {
            throw TeamException::noData();
        }
        return $teams;
    }

    /**
     * @param int $teamId
     * @return Team
     */
    public function getById(int $teamId): Team
    {
        return Team::findOrFail($teamId);
    }
}