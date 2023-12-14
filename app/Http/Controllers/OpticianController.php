<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OpticianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row = User::role('optica')->get();
        foreach ($row as $key => $value) {
           
        }
        return $row; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $row = new User();
        $row->name = $request->name;
        $row->email = $request->email;
        $row->phone = $request->phone;
        $row->web = $request->web;
        $row->instagram = $request->instagram;
        $row->facebook = $request->facebook;
        $row->twitter = $request->twitter;
        $row->states_id = $request->states_id;
        $row->towns_id = $request->towns_id;
        $row->address = $request->address;
        $row->lng = $request->lng;
        $row->lat = $request->lat;
        $row->password = bcrypt($request->password);
        $row->save();

        return $row;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $row
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = User::find($id);
        $row->lat = floatval($row->lat);
        $row->lng = floatval($row->lng);
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
        $row = User::find($id);
        $row->name = $request->name;
        $row->email = $request->email;
        $row->phone = $request->phone;
        $row->web = $request->web;
        $row->instagram = $request->instagram;
        $row->facebook = $request->facebook;
        $row->twitter = $request->twitter;
        $row->states_id = $request->states_id;
        $row->towns_id = $request->towns_id;
        $row->address = $request->address;
        $row->lng = $request->lng;
        $row->lat = $request->lat;
        if(isset($request->password)){
            $row->password = bcrypt($request->password);
        }
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
        $temp = User::find($id);

        if ($temp->delete()) {
            return true;
        }
        else{
            return false;
        }
    }
}
