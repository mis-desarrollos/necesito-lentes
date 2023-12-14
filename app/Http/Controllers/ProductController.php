<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\ProductsImages;

use Illuminate\Http\Request;
use Carbon\Carbon;

// use App\Imports\ProductsImport;
// use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row = Product::all();
        foreach ($row as $key => $value) {
            $images = ProductsImages::where('frames_id',$value->id)->first();
            if ($images) {
                $value->image = Images::getImg($images->images_id);
            }
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
        $row = new Product();
        $row->name = $request->name;
        $row->description = $request->description;
        $row->width = $request->width;
        $row->high = $request->high;
        $row->long = $request->long;
        $row->materials_id = $request->materials_id;
        $row->packages_id = $request->packages_id;
        $row->coverings_id = $request->coverings_id;
        
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
        $row = Product::find($id);
        $images = ProductsImages::where('frames_id',$id)->get();
        foreach ($images as $key => $value) {
            $value->url = Images::getUrl($value->images_id);
        }
        $row->images = $images;
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
        $row = Product::find($id);
        $row->name = $request->name;
        $row->description = $request->description;
        $row->width = $request->width;
        $row->high = $request->high;
        $row->long = $request->long;
        $row->materials_id = $request->materials_id;
        $row->packages_id = $request->packages_id;

        $row->coverings_id = $request->coverings_id;
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
        $temp = Product::find($id);

        if ($temp->delete()) {
            return true;
        }
        else{
            return false;
        }
    }

    public function uploadImage(Request $request, $id)
    {
        if($request->has('file'))
        {
            $imagep = new ProductsImages();
            $imagep->frames_id = $id;
            $imagep->images_id = Images::save($request->file('file'));
            $imagep->save();
        }

        return response()->json('Imagen cargada!');
    }
    public function deleteImage($id)
    {
        ProductsImages::where('id', $id)->delete();
        return response()->json(array("msg" => 'Imagen eliminada'));
    }
}
