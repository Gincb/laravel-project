<?php

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\ProjectException;
use App\Project;
use App\Repositories\ProjectRepository;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProjectService
 * @package App\Services\API
 */
class ProjectService extends ApiService
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * ProjectService constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getPaginateData(): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $projects */
        $projects = $this->projectRepository->paginate();

        if ($projects->isEmpty()) {
            throw ProjectException::noData();
        }

        return $projects;
    }

    /**
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     * @throws \Exception
     */
    public function getFullData(): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $projects */
        $projects = $this->projectRepository->with(['objectives', 'teams'])->paginate();
        if ($projects->isEmpty()) {
            throw ProjectException::noData();
        }
        return $projects;
    }

    /**
     * @param int $projectId
     * @return Project|Model
     * @throws \Exception
     */
    public function getById(int $projectId)
    {
        return $this->projectRepository->findOrFail($projectId);
    }
}