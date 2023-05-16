<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Order;

class OrderController extends Controller
{
    private function distance($x1,$y1,$x2,$y2) {
        $dx = abs($x2 - $x1);
        $dy = abs($y2 - $y1);
        return ($dx + $dy);
    }

    public function store(Request $request) {
                
        $url = 'https://taxi.laferov.ru/api/drivers/active';
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
            $order->order_status = 'way_to_passenger';
            $order->from = json_encode($from);
            $order->to = json_encode($to);
        
        try {
            $order->save();
            return response()->json(['status' => 'success'])->setStatusCode(200);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
        
    }

    public function getDriverStatus($id) {
        $driver_status = Driver::find($id)->only('status');
        return $driver_status;
    }

    public function getDriverPos($id) {
        $driver_pos = Driver::find($id);
        return $driver_pos;
    }

    public function setDriverPos(Request $request, $id) {
        $validated = $request->validate([
            'pos_x' => 'required|integer|between:0,1000',
            'pos_y' => 'required|integer|between:0,1000',
        ]);

        $x = $request->input('pos_x');
        $y = $request->input('pos_y');
        $driver_pos = Driver::find($id);
        $position = ["x" => $x, "y" => $y];
        $driver_pos->driver_pos = json_encode($position);
        $driver_pos->save();
        
        return True;
    }

    public function getActiveDrivers() {
        $drivers = Driver::where('status',1)->get(['id','driver_pos']);
        $ready_drivers = [];
        foreach ($drivers as $driver) {
            $driver_pos = json_decode($driver->driver_pos,true);
            $ready_drivers[strval($driver->id)] = $driver_pos;
        }
        
        return json_encode($ready_drivers);
    }

}
