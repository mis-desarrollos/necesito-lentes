<?php

namespace App\Http\Controllers;

use App\Http\Requests\Antireflective\CreateAntireflectiveRequest;
use App\Http\Requests\Antireflective\UpdateAntireflectiveRequest;
use App\Http\Resources\Antireflective\AntireflectiveDataCollection;
use App\Http\Resources\Antireflective\AntireflectiveResource;
use App\Models\Antireflective;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AntireflectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = Antireflective::paginate();
            return new AntireflectiveDataCollection($data);
        } catch (\Throwable $th) {
            // Log::error($th);
            return response([
                'message' => $th->getMessage()
            ], 500);
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
            $data = $request->all();
            // $data['user_id'] = auth()->user()->id;
            $package = Package::find($request->package);
            $nAntireflective = $package->antireflectives()->create($data);
            return response(new AntireflectiveResource($nAntireflective));
        } catch (\Throwable $th) {
            // Log::error($th);
            return response([
                'message' => $th->getMessage()
            ], 500);
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
            $row = Antireflective::findOrFail($id);
            Log::debug('sdas', [$row->package]);
            return response(new AntireflectiveResource($row));
        } catch (\Throwable $th) {
            // Log::error($th);
            return response([
                'message' => $th->getMessage()
            ], 500);
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
            $antireflective = Antireflective::find($id);
            $antireflective->update($request->all());
            $antireflective->package()->sync($request->package);
            return response(new AntireflectiveResource($antireflective));
        } catch (\Throwable $th) {
            // Log::error($th);
            return response([
                'message' => $th->getMessage()
            ], 500);
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
}
