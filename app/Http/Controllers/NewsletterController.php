<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Newsletter::all();

        foreach ($news as $key => $value) {
            $value->created = $value->created_at->format('d-m-Y H:i:s');
        }
        return response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new Newsletter();
        $news->email = $request->email; 
       
        $news->save();

        return response()->json($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newsletter  $Newsletter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = Newsletter::find($id);
       
        return response()->json($new);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsletter  $Newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = Newsletter::find($id);
        $news->email = $request->email;
       
        $news->save();

        return response()->json($news->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsletter  $Newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->_deleteNews($id)){
            return response()->json(['msg'=>'Registro con ID '.$id.' eliminado.']);
        }
        else{
            return response()->json(['msg'=>'Ocurrio un error al eliminar.'],500);
        }
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->ids as $key => $value) {
            $status=$this->_deleteNews($value);
            if(!$status)
                break;
        }

        if ($status) {
            return response()->json(['msg'=>'Registros eliminadas.']);
        }
        else{
            return response()->json(['msg'=>'Ocurrio un error al eliminar.'],500);
        }
    }

    private function _deleteNews($id)
    {
        $news = Newsletter::find($id);
        
        if ($news->delete()) {
            return true;
        }
        else{
            return false;
        }
    }
}
