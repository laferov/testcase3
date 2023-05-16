<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Order;

class OrderController extends Controller
{
    protected $site_domain;
    protected $order_statuses;

    public function __construct() {
        $this->site_domain = config('app.url');
        $this->order_statuses = array('way_to_pass','way_to_dest','waiting','finished');
    }

    private function distance($x1,$y1,$x2,$y2) {
        $dx = abs($x2 - $x1);
        $dy = abs($y2 - $y1);
        return ($dx + $dy);
    }

    public function store(Request $request) {
        $url = $this->site_domain . '/api/drivers/active';
        $active_drivers = Http::get($url)->body();
        $active_drivers = json_decode($active_drivers,true);
        $from = array(
            "x" => $request->from_x,
            "y" => $request->from_y,
        );

        $to = array(
            "x" => $request->to_x,
            "y" => $request->to_y,
        );


        $driver_distance = [];
        foreach ($active_drivers as $id => $driver) {
            $x2 = intval($driver['x']);
            $y2 = intval($driver['y']);
            $driver_distance[$id] = $this->distance($from['x'],$from['y'],$x2,$y2);
        }


        $nearest_driver_id = array_search(min($driver_distance),$driver_distance);
        $distance = min($driver_distance);

        $order = new Order;
            $order->driver_id = $nearest_driver_id;
            $order->order_status = 'way_to_pass';
            $order->from = json_encode($from);
            $order->to = json_encode($to);
        

        
        try {
            $order->save();
            return response()->json(['status' => 'success'])->setStatusCode(200);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
        
    }

    public function changeStatus($id,$status) {
        if (!in_array($status,$this->order_statuses)) {
            return response()->json(['status' => 'order status not exist'])->setStatusCode(400);
        }

        $order = Order::find($id);
        $order->order_status = $status;
        $order->save(); 

        return response()->json(['status' => 'success changing status'])->setStatusCode(200);

        

    }

}
