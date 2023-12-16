<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\StoreMaterialRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Http\Resources\Material\MaterialDataCollection;
use App\Http\Resources\Material\MaterialResource;
use App\Services\Material\MaterialService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class MaterialController extends Controller
{
    const MATERIAL_NOT_FOUND_MSG = 'Material not found';

    public function __construct(
        protected MaterialService $materialService
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
            $data = $this->materialService->getAllMaterialsPaginated();
            return new MaterialDataCollection($data);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error loading materials');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaterialRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $material = $this->materialService->createMaterial($validatedData);
            return $this->handleSuccessResponse($material);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error creating material');
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
            $material = $this->materialService->getMaterialById($id);
            if (!$material) {
                throw new ModelNotFoundException(self::MATERIAL_NOT_FOUND_MSG);
            }
            return $this->handleSuccessResponse($material);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse($e, 'Error finding material');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaterialRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $material = $this->materialService->getMaterialById($id);

            if (!$material) {
                throw new ModelNotFoundException(self::MATERIAL_NOT_FOUND_MSG);
            }

            $this->materialService->updateMaterial($material, $validatedData);

            return $this->handleSuccessResponse($material);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->handleErrorResponse($th, 'Error updating material');
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
            $frame = $this->materialService->deleteMaterial($id);
            if (!$frame) {
                throw new ModelNotFoundException(self::MATERIAL_NOT_FOUND_MSG);
            }
            return response()->json(['message' => 'Material deleted successfully'], JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->handleErrorResponse($e, 'Error Destroying material');
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error Destroying material');
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            $ids = $request->input('ids');
            $materials = $this->materialService->getMaterialByIds($ids);

            if (!$materials) {
                throw new ModelNotFoundException(self::MATERIAL_NOT_FOUND_MSG);
            }
            $deleted = $this->materialService->deleteMultipleMaterials($materials);
            if (!$deleted) {
                throw new ModelNotFoundException(self::MATERIAL_NOT_FOUND_MSG);
            }
            return response()->json(
                ['message' => 'Frames and associated images deleted successfully'],
                JsonResponse::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error destroyMultiple frames');
        }
    }

    protected function handleSuccessResponse($material)
    {
        $material->load('package');
        return new MaterialResource($material);
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
