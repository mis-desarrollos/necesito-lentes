<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\User; 
use Carbon\Carbon;
use App\Exports\OrdersExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        
        foreach($orders as $order){
            $order->total = '$'.$order->total;
            $order->subtotal = '$'.$order->subtotal;
        }

        /*$ordersToDay   = Order::whereDate('created_at', Carbon::today())->count(); 
        $ordersToMonth = Order::whereDate('created_at', '>', Carbon::now()->subDays(30))->count();
        $totalToDay    = Order::whereDate('created_at', Carbon::today())->sum('total');
        $totalToMonth  = Order::whereDate('created_at', '>', Carbon::now()->subDays(30))->sum('total');*/
        
        $ordersToDay   = Order::count(); 
        $ordersToMonth = Order::count();
        $totalToDay    = Order::sum('total');
        $totalToMonth  = Order::sum('total');

        return response()->json(['orders' => $orders, 'totals' => [ 'totalToDay' => $totalToDay, 'totalToMonth'=> $totalToMonth, 'ordersToDay'=> $ordersToDay, 'ordersToMonth'=> $ordersToMonth]]);
    }

    public function Filter(Request $request)
    {
        $orders = Order::with('user')->where('created_at','>',$request->desde.' 00:00:00')->where('created_at','<',$request->hasta.' 23:59:59')->get();
        
        foreach($orders as $order){
            $order->total = '$'.$order->total;
            $order->subtotal = '$'.$order->subtotal;
        }

        /*$ordersToDay   = Order::whereDate('created_at', Carbon::today())->count(); 
        $ordersToMonth = Order::whereDate('created_at', '>', Carbon::now()->subDays(30))->count();
        $totalToDay    = Order::whereDate('created_at', Carbon::today())->sum('total');
        $totalToMonth  = Order::whereDate('created_at', '>', Carbon::now()->subDays(30))->sum('total'); */
        $ordersToDay   = Order::count(); 
        $ordersToMonth = Order::count();
        $totalToDay    = Order::sum('total');
        $totalToMonth  = Order::sum('total');

        return response()->json(['orders' => $orders, 'totals' => [ 'totalToDay' => $totalToDay, 'totalToMonth'=> $totalToMonth, 'ordersToDay'=> $ordersToDay, 'ordersToMonth'=> $ordersToMonth]]);
    

        return response()->json($orders);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = [];
        $details = [];

        $order = Order::where('id', $id)->with('town', 'state')->first();
        
        if($order){
            $user = User::where('id', $order->user_id)->with('address')->first();
            $details = OrderDetail::where('order_id', $order->id)->with('product')->get();
        }

        return  response()->json(['order' => $order, 'user' => $user, 'details' => $details]);
    }

    public function setStatus(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        if($order)
        {
            if($order->status != $request->status)
            {
                $order->status = $request->status;
                $order->save();
            }
            return response()->json(['msg'=>'Pedido actualizado correctamente'],200);
        }
        else
            return response()->json(['msg'=>'Ocurrio un error al actualizar el pedido'],500);

    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'ventas.xlsx');
    }
}
