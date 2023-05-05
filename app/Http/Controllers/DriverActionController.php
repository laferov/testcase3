<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function setpos($id) {
      $driver_location = Driver::find($id);
      if (empty($driver_location)) {
         return 'Driver is unactive';
      } else
      {
         
      }
    } 
}
