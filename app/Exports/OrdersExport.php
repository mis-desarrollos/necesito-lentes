<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use App\Models\Order;

class OrdersExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $orders = Order::with('user')->orderBy('created_at', 'DESC')->get();
        $data = [];
        foreach($orders as $order){
            $aux = [
                'id'=>$order->id,
                'date'=>$order->created_at->format('d-m-Y H:i:s'),
                'subtotal'=>'$'.$order->subtotal,
                'total'=>'$'.$order->total,

                'fullname'=>$order->user->name.' '.$order->user->lastname,
                'emailcustomer'=>$order->user->email,
            ];
            array_push($data,$aux);
        }

        return $data;
    }
}
