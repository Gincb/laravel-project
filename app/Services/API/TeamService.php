<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\TeamException;
use App\Repositories\TeamRepository;
use App\Services\ApiService;
use App\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamService
 * @package App\Services\API
 */
class TeamService extends ApiService
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * TeamService constructor.
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @return LengthAwarePaginator|LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData()
    {
        /** @var LengthAwarePaginator $team */
        $teams = $this->teamRepository->paginate();

        if ($teams->isEmpty()) {
            throw TeamException::noData();
        }

        return $teams;
    }

    /**
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getFullData(): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $teams */
        $teams = $this->teamRepository->with(['members'])->paginate();
        if ($teams->isEmpty()) {
            throw TeamException::noData();
        }
        return $teams;
    }

    /**
     * @param int $teamId
     * @return Team|Model
     * @throws \Exception
     */
    public function getById(int $teamId)
    {
        return $this->teamRepository->findOrFail($teamId);
    }
}