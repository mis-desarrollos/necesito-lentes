<?php

namespace App\Http\Controllers;

use App\Http\Requests\Package\PackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Models\Frame;
use App\Models\Package;
use App\Services\Package\PackageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PackageController extends Controller
{
    public function __construct(
        protected PackageService $packageService,
    ) {
    }

    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $packages = $this->packageService->getAllPackagesPaginated();
            return PackageResource::collection($packages);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error loading packages');
        }
    }
    
    public function store(PackageRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $package = $this->packageService->createPackage($validatedData);
            $this->packageService->saveFrames($package, $validatedData['frames']);
            $this->packageService->saveAntireflectives($package, $validatedData['frames']);
            $this->packageService->saveMaterials($package, $validatedData['frames']);
            return new PackageResource($package);

        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Error creating package: ' . $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
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
        $row = Package::find($id);
        return $row;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $row = Package::find($id);
        $row->name = $request->name;
        $row->price = $request->price;
        $row->description = $request->description;
        $row->save();

        return $row;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->_delete($id)){
            return response()->json(['msg'=>'Registro con ID '.$id.' eliminado.']);
        }
        else{
            return response()->json(['msg'=>'Ocurrio un error al eliminar.'],500);
        }
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->ids as $key => $value) {
            $status=$this->_delete($value);
            if(!$status)
                break;
        }

        if ($status) {
            return response()->json(['msg'=>'Registros eliminados.']);
        }
        else{
            return response()->json(['msg'=>'Ocurrio un error al eliminar.'],500);
        }
    }

    private function _delete($id)
    {
        $temp = Package::find($id);

        if ($temp->delete()) {
            return true;
        }
        else{
            return false;
        }
    }
}
