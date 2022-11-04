<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = User::role('cliente')->get();
        return response()->json($customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User(array(
            'email' => $request->email,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'access' => 0,
        ));

        $user->save();
        $user->syncRoles('cliente');

        $customer = new Address();
        $customer->user_id = $user->id;
        $customer->street = $request->street;
        $customer->num_ext = $request->num_ext;
        $customer->num_int = $request->num_int;
        $customer->neighborhood = $request->neighborhood;
        $customer->zipcode = $request->zipcode;
        $customer->state_id = $request->state_id;
        $customer->town_id = $request->town_id;
        $customer->save();
        
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::role('cliente')->where('id', $id)->first();
        
        $data = array(
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'lastname' => $user->lastname,
            'phone' => $user->phone,
            'street' => $user->address->street,
            'num_ext' => $user->address->num_ext,
            'num_int' => $user->address->num_int,
            'neighborhood' => $user->address->neighborhood,
            'zipcode' => $user->address->zipcode,
            'town_id' => $user->address->town_id,
            'state_id' => $user->address->state_id
        );

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        
        $user->save();

        $address = Address::where('user_id', $id)->first();
        $address->street = $request->street;
        $address->num_ext = $request->num_ext;
        $address->num_int = $request->num_int;
        $address->neighborhood = $request->neighborhood;
        $address->zipcode = $request->zipcode;
        $address->state_id = $request->state_id;
        $address->town_id = $request->town_id;
        $address->save();

        return response()->json($user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->_deleteUser($id)){
            return response()->json(['msg'=>'Usuario con ID '.$id.' eliminado.']);
        }
        else{
            return response()->json(['msg'=>'Ocurrio un error al eliminar.'],500);
        }
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->ids as $key => $value) {
            $status=$this->_deleteUser($value);
            if(!$status)
                break;
        }

        if ($status) {
            return response()->json(['msg'=>'Usuarios eliminados.']);
        }
        else{
            return response()->json(['msg'=>'Ocurrio un error al eliminar.'],500);
        }
    }

    private function _deleteUser($user_id)
    {
        $user = User::find($user_id);

        if ($user->delete()) {
            return true;
        }
        else{
            return false;
        }
    }
}
