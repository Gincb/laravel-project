<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Exceptions\ObjectiveException;
use App\Services\API\ObjectiveService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;

/**
 * Class ObjectiveController
 * @package App\Http\Controllers\API
 */
class ObjectiveController extends Controller
{
    /**
     * @var ObjectiveService
     */
    private $objectiveService;

    /**
     * ObjectiveController constructor.
     * @param ObjectiveService $objectiveService
     */
    public function __construct(ObjectiveService $objectiveService)
    {
        $this->objectiveService = $objectiveService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginate(Request $request): JsonResponse
    {
        try {
            $objectives = $this->objectiveService->getPaginateData((int)$request->page);
            return response()->json([
                'status' => true,
                'data' => $objectives->getCollection(),
                'current_page' => $objectives->currentPage(),
                'total_page' => $objectives->lastPage(),
            ]);
        } catch (ObjectiveException $exception) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        } catch (\Throwable $exception) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Something wrong',
                    'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFullData(Request $request): JsonResponse
    {
        try {
            $objectives = $this->objectiveService->getFullData((int)$request->page);
            return response()->json([
                'success' => true,
                'data' => $objectives,
            ]);
        } catch (ObjectiveException $exception) {
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
            $objective = $this->objectiveService->getById($id);
            return response()->json([
                'success' => true,
                'data' => $objective,
            ]);
        } catch (ModelNotFoundException $exception) {
            logger($exception->getMessage(), [
                'code' => $exception->getCode(),
                'objective-id' => $id,
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
