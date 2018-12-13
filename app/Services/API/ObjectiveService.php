<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\ObjectiveException;
use App\Objective;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ObjectiveService
 * @package App\Services\API
 */
class ObjectiveService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $objective */
        $objectives = Objective::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($objectives->isEmpty()) {
            throw ObjectiveException::noData();
        }

        return $objectives;
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $objectives */
        $objectives = Objective::with(['plans'])->paginate(self::PER_PAGE, ['*'], 'page', $page);
        if ($objectives->isEmpty()) {
            throw ObjectiveException::noData();
        }
        return $objectives;
    }

    /**
     * @param int $objectiveId
     * @return Objective
     */
    public function getById(int $objectiveId): Objective
    {
        return Objective::findOrFail($objectiveId);
    }
}