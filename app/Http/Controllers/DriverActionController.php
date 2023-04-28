<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverActionController extends Controller
{
    public function changestatus($id) {
       $driver = Driver::find($id);
       $driver->status = !$driver->status;
       $driver->save();
       $temp = compact('driver');
       return back();
       #return view('driver.show', compact('driver'));
    }

    public function checkstatus($id) {
        $driver = Driver::find($id)->status;
        dd($driver);
     }
}
