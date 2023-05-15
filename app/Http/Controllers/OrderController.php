<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{

    private function distance($x1,$y1,$x2,$y2) {
        $dx = abs($x2 - $x1);
        $dy = abs($y2 - $y1);
        return ($dx + $dy);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate();

        return view('order.index', compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * $orders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        return view('order.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = 'https://taxi.laferov.ru/api/drivers/active';
        $active_drivers = Http::get($url)->body();
        dd($active_drivers);
        $active_drivers = json_decode($active_drivers,true);
        dd($active_drivers);
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
            $driver_distance[$id] = $this->distance($x1,$y1,$x2,$y2);
        }

        $nearest_driver_id = array_search(min($driver_distance),$driver_distance);
        $distance = min($driver_distance);


        $from = array(
            "x" => $request->from_x,
            "y" => $request->from_y,
        );
        dd($from->toJson());
        $order = Order::create($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        request()->validate(Order::$rules);

        $order->update($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $order = Order::find($id)->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}
