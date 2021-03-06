<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-12-13
 * Time: 19:28
 */

declare(strict_types = 1);

namespace App\Repositories;

use App\Plan;

/**
 * Class ProjectRepository
 * @package App\Repositories
 */
class PlanRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Plan::class;
    }
}