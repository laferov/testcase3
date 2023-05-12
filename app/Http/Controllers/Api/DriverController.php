<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Driver;

class DriverController extends Controller
{
    public function index() {
        $drivers = Driver::all();
        return $drivers->toJson();
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
