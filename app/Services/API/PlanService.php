<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\PlanException;
use App\Repositories\PlanRepository;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PlanService
 * @package App\Services\API
 */
class PlanService extends ApiService
{
    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * PlanService constructor.
     * @param PlanRepository $planRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $plans */
        $plans = $this->planRepository->paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($plans->isEmpty()) {
            throw PlanException::noData();
        }

        return $plans;
    }

    /**
     * @param int $planId
     * @return Model
     * @throws \Exception
     */
    public function getById(int $planId): Model
    {
        $plan = $this->planRepository->findOrFail($planId);

        return $plan;
    }
}