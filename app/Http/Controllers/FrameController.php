<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frame\FrameRequest;
use App\Http\Resources\Frame\FrameResource;
use App\Services\Frame\FrameService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class FrameController extends Controller
{
    const FRAME_NOT_FOUND_MSG = 'Frame not found';

    public function __construct(
        protected FrameService $frameService
    ) {
    }
    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $frames = $this->frameService->getAllFramesPaginated();
            $frames->load('images');
            return FrameResource::collection($frames);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error loading frames');
        }
    }

    public function store(FrameRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $frame = $this->frameService->createFrame($validatedData);
            $images = $request->file('images');
            if ($images) {
                $this->frameService->saveImagesForFrame($frame, $images);
            }
            return $this->handleSuccessResponse($frame);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error creating frame');
        }
    }

    public function show(
        $id
    ): FrameResource|JsonResponse {
        try {
            $frame = $this->frameService->getFrameById($id);
            if (!$frame) {
                throw new ModelNotFoundException(self::FRAME_NOT_FOUND_MSG);
            }

            return $this->handleSuccessResponse($frame);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error finding frame');
        }
    }

    // Laravel PATCH and PUT method does not work with form-data
    public function update(FrameRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $frame = $this->frameService->getFrameById($id);

            if (!$frame) {
                throw new ModelNotFoundException(self::FRAME_NOT_FOUND_MSG);
            }

            $this->frameService->updateFrame($frame, $validatedData);

            return $this->handleSuccessResponse($frame);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error updating frame');
        }
    }

    public function destroy(
        $id
    ): JsonResponse {
        try {
            $frame = $this->frameService->deleteFrame($id);

            if (!$frame) {
                throw new ModelNotFoundException(self::FRAME_NOT_FOUND_MSG);
            }

            $this->frameService->deleteImagesForFrame($frame);

            return response()->json(['message' => 'Frame deleted successfully'], JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            // return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
            return $this->handleErrorResponse($e, 'Error Destroying frame');
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error Destroying frame');
        }
    }

    public function destroyMultiple(Request $request): JsonResponse
    {
        try {
            $ids = $request->input('ids');
            $frames = $this->frameService->getFrameByIds($ids);

            if (!$frames) {
                throw new ModelNotFoundException(self::FRAME_NOT_FOUND_MSG);
            }

            $this->frameService->deleteImagesAssociatedWithFrames($frames);
            $deleted = $this->frameService->deleteMultipleFrames($frames);

            if (!$deleted) {
                throw new ModelNotFoundException(self::FRAME_NOT_FOUND_MSG);
            }

            return response()->json(
                ['message' => 'Frames and associated images deleted successfully'], JsonResponse::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error destroyMultiple frames');
        }
    }

    protected function handleSuccessResponse($frame)
    {
        $frame->load('images');
        return new FrameResource($frame);
    }

    protected function handleErrorResponse($e, $message)
    {
        Log::error("{$message}: {$e}");
        return response()->json(
            ['message' => "{$message}: {$e->getMessage()}"], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
