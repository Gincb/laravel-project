<?php

namespace App\Http\Controllers\API;

use App\Exceptions\TeamException;
use App\Services\API\TeamService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;

/**
 * Class TeamController
 * @package App\Http\Controllers\API
 */
class TeamController extends Controller
{
    /**
     * @var TeamService
     */
    private $teamService;

    /**
     * TeamController constructor.
     * @param TeamService $teamService
     */
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginate(Request $request): JsonResponse
    {
        try {
            $teams = $this->teamService->getPaginateData((int)$request->page);
            return response()->json([
                'status' => true,
                'data' => $teams->getCollection(),
                'current_page' => $teams->currentPage(),
                'total_page' => $teams->lastPage(),
            ]);
        } catch (TeamException $exception) {
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
            $teams = $this->teamService->getFullData((int)$request->page);
            return response()->json([
                'success' => true,
                'data' => $teams,
            ]);
        } catch (TeamException $exception) {
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
            $team = $this->teamService->getById($id);
            return response()->json([
                'success' => true,
                'data' => $team,
            ]);
        } catch (ModelNotFoundException $exception) {
            logger($exception->getMessage(), [
                'code' => $exception->getCode(),
                'team-id' => $id,
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
