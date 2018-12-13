<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\PlanException;
use App\Plan;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PlanService
 * @package App\Services\API
 */
class PlanService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1)
    {
        /** @var LengthAwarePaginator $plan */
        $plan = Plan::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($plan->isEmpty()) {
            throw PlanException::noData();
        }

        return $plan;
    }

    /**
     * @param int $planId
     * @return Plan
     */
    public function getById(int $planId): Plan
    {
        return Plan::findOrFail($planId);
    }
}