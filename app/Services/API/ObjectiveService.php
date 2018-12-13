<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\ObjectiveException;
use App\Objective;
use App\Repositories\ObjectiveRepository;
use App\Services\ApiService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ObjectiveService
 * @package App\Services\API
 */
class ObjectiveService extends ApiService
{
    /**
     * @var ObjectiveRepository
     */
    private $objectiveRepository;

    /**
     * ObjectiveService constructor.
     * @param ObjectiveRepository $objectiveRepository
     */
    public function __construct(ObjectiveRepository $objectiveRepository)
    {
        $this->objectiveRepository = $objectiveRepository;
    }

    /**
     * @return LengthAwarePaginator|LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData()
    {
        /** @var LengthAwarePaginator $objective */
        $objectives = $this->objectiveRepository->paginate();

        if ($objectives->isEmpty()) {
            throw ObjectiveException::noData();
        }

        return $objectives;
    }

    /**
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getFullData(): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $objectives */
        $objectives = $this->objectiveRepository->with(['plans'])->paginate();
        if ($objectives->isEmpty()) {
            throw ObjectiveException::noData();
        }
        return $objectives;
    }

    /**
     * @param int $objectiveId
     * @return Objective|Model
     * @throws \Exception
     */
    public function getById(int $objectiveId)
    {
        return $this->objectiveRepository->findOrFail($objectiveId);
    }
}