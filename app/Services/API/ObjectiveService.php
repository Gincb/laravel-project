<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\ObjectiveException;
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
     * @param int $page
     * @return LengthAwarePaginator|LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $objective */
        $objectives = $this->objectiveRepository->paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($objectives->isEmpty()) {
            throw ObjectiveException::noData();
        }

        return $objectives;
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $objectives */
        $objectives = $this->objectiveRepository->with(['plans'])->paginate(self::PER_PAGE, ['*'], 'page', $page);
        if ($objectives->isEmpty()) {
            throw ObjectiveException::noData();
        }
        return $objectives;
    }

    /**
     * @param int $objectiveId
     * @return Model
     * @throws \Exception
     */
    public function getById(int $objectiveId): Model
    {
        return $this->objectiveRepository->findOrFail($objectiveId);
    }
}