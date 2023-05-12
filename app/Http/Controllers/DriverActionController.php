<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Driver;
use App\Models\DriverOrder;


class DriverActionController extends Controller
{
    public function changestatus($id) {
       $driver = Driver::find($id);
       $driver->status = !$driver->status;
       $driver->save();
       $temp = compact('driver');
       return back();
    }

    public function checkstatus($id) {
        $driver = Driver::find($id)->status;
        dd($driver);
     }
    public function setpos(Request $request, $id) {
      
      $action = app('App\Http\Controllers\Api\DriverController')->setDriverPos($request,$id);
      if ($action) {
         return redirect()->route('drivers.show',$id)->with('success','Success update of driver position');
      }
      return redirect()->route('drivers.show',$id)->with('error','Error');
      

    } 
}
