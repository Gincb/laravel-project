<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\ProjectException;
use App\Project;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProjectService
 * @package App\Services\API
 */
class ProjectService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $projects */
        $projects = Project::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($projects->isEmpty()) {
            throw ProjectException::noData();
        }

        return $projects;
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $projects */
        $projects = Project::with(['objectives', 'teams'])->paginate(self::PER_PAGE, ['*'], 'page', $page);
        if ($projects->isEmpty()) {
            throw ProjectException::noData();
        }
        return $projects;
    }

    /**
     * @param int $projectId
     * @return Project
     */
    public function getById(int $projectId): Project
    {
        return Project::findOrFail($projectId);
    }
}