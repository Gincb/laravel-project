<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-12-13
 * Time: 19:28
 */

declare(strict_types = 1);

namespace App\Repositories;

use App\Project;

/**
 * Class ProjectRepository
 * @package App\Repositories
 * @method getBySlugAndNotId(string $getSlug, int $param)
 */
class ProjectRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Project::class;
    }
}