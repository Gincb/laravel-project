<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-12-13
 * Time: 19:28
 */

declare(strict_types = 1);

namespace App\Repositories;

use App\Objective;

/**
 * Class ProjectRepository
 * @package App\Repositories
 * @method getBySlug(string $getSlug)
 * @method getBySlugAndNotId(string $getSlug, int $param)
 */
class ObjectiveRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Objective::class;
    }
}