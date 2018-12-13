<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Exceptions\ProjectException;
use App\Services\API\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;

/**
 * Class ProjectController
 * @package App\Http\Controllers\API
 */
class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * ProjectController constructor.
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginate(Request $request): JsonResponse
    {
        try {
            $projects = $this->projectService->getPaginateData((int)$request->page);

            return response()->json([
                'status' => 'true',
                'data' => $projects->getCollection(),
                'current_page' => $projects->currentPage(),
                'total_page' => $projects->lastPage(),
            ]);
        } catch (ProjectException $exception) {
            logger($exception->getMessage(), [
                'code' => $exception->getCode(),
                'page' => $request->page,
                'url' => $request->fullUrl(),
            ]);

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Something wrong',
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFullData(Request $request): JsonResponse
    {
        try {
            $projects = $this->projectService->getFullData((int)$request->page);
            return response()->json([
                'success' => true,
                'data' => $projects,
            ]);
        } catch (ProjectException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function getById(Request $request, int $id): JsonResponse
    {
        try {
            $project = $this->projectService->getById($id);
            return response()->json([
                'success' => true,
                'data' => $project,
            ]);
        } catch (ModelNotFoundException $exception) {
            logger($exception->getMessage(), [
                'code' => $exception->getCode(),
                'project-id' => $id,
                'path' => $request->path(),
                'url' => $request->url(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'No data found.',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
