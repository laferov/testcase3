<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Driver;

class DriverController extends Controller
{
    public function index() {
        $drivers = Driver::all();
        return $drivers->toJson();
    }

    public function getDriverStatus($id) {
        #$driver_status = Driver::find($id)->status->pluck('status');
        $driver_status = DB::table('drivers')->select('status')->where('id',$id)->get();
        return $driver_status[0];
    }

    public function getDriverPos($id) {
        $driver_pos = Driver::find($id)->driver_pos;
        return $driver_pos;
    }

    public function setDriverPos($id,$x,$y) {
        $driver_pos = Driver::find($id);
        $position = ["x" => $x, "y" => $y];
        $driver_pos->driver_pos = json_encode($position);
        $driver_pos->save();
        return;
    }

    
}
