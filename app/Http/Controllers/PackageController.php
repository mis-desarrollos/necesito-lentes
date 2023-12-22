<?php

namespace App\Http\Controllers;

use App\Http\Requests\Package\PackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Models\Frame;
use App\Models\Package;
use App\Services\Package\PackageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    public function __construct(
        protected PackageService $packageService,
    ) {
        // $this->middleware('auth:sanctum', ['except' => ['index']]);
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
            $this->packageService->saveFrames($package, $validatedData['frames'] ?? []);
            $this->packageService->saveAntireflectives($package, $validatedData['antireflectives'] ?? []);
            $this->packageService->saveMaterials($package, $validatedData['materials'] ?? []);
            return new PackageResource($package);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Error creating package: ' . $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
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
        try {
            $package = $this->packageService->getPackageById($id);
            if (!$package) {
                throw new ModelNotFoundException('Package not found');
            }
            $package->load('frames');
            $package->load('antireflectives');
            $package->load('materials');
            return new PackageResource($package);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->handleErrorResponse($e, 'Error finding frame');
        }
    }

    public function update(PackageRequest $request, $id)
    {
        $validatedData = $request->validated();
        try {
            $package = $this->packageService->getPackageById($id);

            if (!$package) {
                throw new ModelNotFoundException('Package not found');
            }
            $package = $this->packageService->updatePackage($package, $validatedData);
            $this->packageService->saveFrames($package, $validatedData['frames'] ?? []);
            $this->packageService->saveAntireflectives($package, $validatedData['antireflectives'] ?? []);
            $this->packageService->saveMaterials($package, $validatedData['materials'] ?? []);
            $package->load('frames');
            $package->load('antireflectives');
            $package->load('materials');
            return new PackageResource($package);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Error actualizando el paquete: ' . $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
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
            $package = Package::findOrFail($id);
            $package->packageables()->delete();
            $package->delete();
            return response()->json(['message' => 'Paquete y elementos relacionados eliminados correctamente']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(
                ['message' => $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            $packages = Package::whereIn('id', $request->ids);
            foreach ($packages as $package) {
                $package->packageables()->delete();
                $package->delete();
            }
            return response()->json(['message' => 'Registros eliminados']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(
                ['message' => $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
