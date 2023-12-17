<?php

namespace App\Http\Controllers;

use App\Http\Requests\Antireflective\CreateAntireflectiveRequest;
use App\Http\Requests\Antireflective\UpdateAntireflectiveRequest;
use App\Http\Resources\Antireflective\AntireflectiveDataCollection;
use App\Http\Resources\Antireflective\AntireflectiveResource;
use App\Services\Antireflective\AntireflectiveService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class AntireflectiveController extends Controller
{
    const NOT_FOUND_MSG = 'Antireflective not found';

    public function __construct(
        protected AntireflectiveService $antireflectiveService
    ) {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = $this->antireflectiveService->getAllAntireflectivesPaginated();
            return new AntireflectiveDataCollection($data);
        } catch (\Throwable $th) {
            return $this->handleErrorResponse($th, 'Error loading Antireflective');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAntireflectiveRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $antireflective = $this->antireflectiveService->createAntireflective($validatedData);
            return $this->handleSuccessResponse($antireflective);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error creating Antireflective');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Antireflective  $row
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $antireflective = $this->antireflectiveService->getAntireflectiveById($id);
            if (!$antireflective) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            return $this->handleSuccessResponse($antireflective);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error finding Antireflective');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Antireflective  $row
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAntireflectiveRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $antireflective = $this->antireflectiveService->getAntireflectiveById($id);

            if (!$antireflective) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }

            $this->antireflectiveService->updateAntireflective($antireflective, $validatedData);

            return $this->handleSuccessResponse($antireflective);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->handleErrorResponse($th, 'Error updating Antireflective');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Antireflective  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $frame = $this->antireflectiveService->deleteAntireflective($id);
            if (!$frame) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            return response()->json(['message' => 'Antireflective deleted successfully'], JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->handleErrorResponse($e, 'Error Destroying antireflective');
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error Destroying antireflective');
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            $ids = $request->input('ids');
            $antireflectives = $this->antireflectiveService->getAntireflectiveByIds($ids);

            if (!$antireflectives) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            $deleted = $this->antireflectiveService->deleteMultipleAntireflectives($antireflectives);
            if (!$deleted) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            return response()->json(
                ['message' => 'Frames and associated images deleted successfully'],
                JsonResponse::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error at destroyMultiple antireflectives');
        }
    }

    protected function handleSuccessResponse($antireflective)
    {
        $antireflective->load('package');
        return response(new AntireflectiveResource($antireflective));
    }

    protected function handleErrorResponse($e, $message)
    {
        Log::error("{$message}: {$e}");
        return response()->json(
            ['message' => "{$message}: {$e->getMessage()}"],
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
