<?php

namespace App\Http\Controllers;

use App\Http\Requests\Optician\OpticianRequest;
use App\Http\Resources\Optician\OpticianDataCollection;
use App\Http\Resources\Optician\OpticianResource;
use App\Models\Image;
use App\Models\Optician;
use App\Models\User;
use App\Services\Image\ImageHandler;
use App\Services\Optician\OpticianService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpticianController extends Controller
{
    const NOT_FOUND_MSG = 'Optician not found';

    public function __construct(
        protected OpticianService $opticianService,
        protected ImageHandler $imageHandler
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
            $data = $this->opticianService->getAllOpticiansPaginated();
            return new OpticianDataCollection($data);
        } catch (\Throwable $th) {
            return $this->handleErrorResponse($th, 'Error loading Optician');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpticianRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $optician = $this->opticianService->createOptician($validatedData);
            return $this->handleSuccessResponse($optician);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error creating optician');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $optician = $this->opticianService->getOpticianById($id);
            if (!$optician) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            return $this->handleSuccessResponse($optician->load('images'));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error finding Optician');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function update(OpticianRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $optician = $this->opticianService->getOpticianById($id);

            if (!$optician) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }

            $this->opticianService->updateOptician($optician, $validatedData);

            return $this->handleSuccessResponse($optician);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->handleErrorResponse($th, 'Error updating optician');
        }
    }

    public function uploadImage(Request $request, Optician $optician)
    {
        try {
            if ($request->has('image')) {
                $image = $request->file('image');
                $this->imageHandler->handleImages($optician, [$image]);
            }
            return response()->json('Imagen cargada!');
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error subiendo la imagen');
        }
    }

    public function deleteImage(Optician $optician, Image $image)
    {
        try {
            $this->imageHandler->handleDeleteImages($optician, collect()->push($image));
            return response()->json(array("message" => 'Imagen eliminada'));
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error eliminando la imagen');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $optician = $this->opticianService->deleteOptician($id);
            if (!$optician) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            return response()->json(['message' => 'Optician deleted successfully'], JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->handleErrorResponse($e, 'Error Destroying Optician');
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error Destroying Optician');
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            $ids = $request->input('ids');
            $opticians = $this->opticianService->getOpticianByIds($ids);

            if (!$opticians) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            $this->opticianService->deleteMultipleOpticians($opticians);

            return response()->json(
                ['message' => 'opticians and associated images deleted successfully'],
                JsonResponse::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error at destroyMultiple Opticians');
        }
    }

    protected function handleSuccessResponse($optician)
    {
        return response(new OpticianResource($optician));
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
