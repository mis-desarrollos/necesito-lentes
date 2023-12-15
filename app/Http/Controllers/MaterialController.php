<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\StoreMaterialRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Http\Resources\Material\MaterialDataCollection;
use App\Http\Resources\Material\MaterialResource;
use App\Models\Material;
use App\Models\Package;
use App\Services\Material\MaterialService;
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
            $data = Material::paginate();
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
            $package = Package::findOrFail($request->package);
            $nMaterial = $package->materials()->create($validatedData);
            return $this->handleSuccessResponse($nMaterial);
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
    public function show(Material $id)
    {
        try {
            return $this->handleSuccessResponse($id);
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
            $material = Material::findOrFail($id);
            $material->update($validatedData);
            $material->package()->sync($request->package);
            return $this->handleSuccessResponse($material);
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
        if ($this->_delete($id)) {
            return response()->json(['msg' => 'Registro con ID ' . $id . ' eliminado.']);
        } else {
            return response()->json(['msg' => 'Ocurrio un error al eliminar.'], 500);
        }
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->ids as $key => $value) {
            $status = $this->_delete($value);
            if (!$status)
                break;
        }

        if ($status) {
            return response()->json(['msg' => 'Registros eliminados.']);
        } else {
            return response()->json(['msg' => 'Ocurrio un error al eliminar.'], 500);
        }
    }

    private function _delete($id)
    {
        $temp = Material::find($id);

        if ($temp->delete()) {
            return true;
        } else {
            return false;
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
            ['message' => "{$message}: {$e->getMessage()}"], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
