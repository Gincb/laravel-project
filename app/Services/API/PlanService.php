<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\PlanException;
use App\Plan;
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
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData(): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $plan */
        $plan = $this->planRepository->paginate();

        if ($plan->isEmpty()) {
            throw PlanException::noData();
        }

        return $plan;
    }

    /**
     * @param int $planId
     * @return Plan|Model
     * @throws \Exception
     */
    public function getById(int $planId)
    {
        return $this->planRepository->findOrFail($planId);
    }
}