<?php

namespace App\Http\Controllers;

use App\Http\Requests\Antireflective\CreateAntireflectiveRequest;
use App\Http\Requests\Antireflective\UpdateAntireflectiveRequest;
use App\Http\Resources\Antireflective\AntireflectiveDataCollection;
use App\Http\Resources\Antireflective\AntireflectiveResource;
use App\Models\Antireflective;
use App\Models\Package;
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
            $material = $this->antireflectiveService->createAntireflective($validatedData);
            return $this->handleSuccessResponse($material);
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
            $material = $this->antireflectiveService->getAntireflectiveById($id);
            if (!$material) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }
            return $this->handleSuccessResponse($material);
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
            $material = $this->antireflectiveService->getAntireflectiveById($id);

            if (!$material) {
                throw new ModelNotFoundException(self::NOT_FOUND_MSG);
            }

            $this->antireflectiveService->updateAntireflective($material, $validatedData);

            return $this->handleSuccessResponse($material);
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
        $temp = Antireflective::find($id);

        if ($temp->delete()) {
            return true;
        }
        else{
            return false;
        }
    }

    protected function handleSuccessResponse($material)
    {
        $material->load('package');
        return new AntireflectiveResource($material);
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
