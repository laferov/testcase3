<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use Illuminate\Http\Request;

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
        #request()->validate(Order::$rules);
        #dd($request->all());

        $active_drivers = '{"3":{"x":"5","y":"5"},"4":{"x":"25","y":"25"}}';
        $active_drivers = json_decode($active_drivers,true);
        $x1 = 1;
        $y1 = 2;
        $driver_distance = [];
        foreach ($active_drivers as $id => $driver) {
            $x2 = intval($driver['x']);
            $y2 = intval($driver['y']);
            $driver_distance[$id] = $this->distance($x1,$y1,$x2,$y2);
        }

        $nearest_driver = array_search(min($driver_distance),$driver_distance);

        $distance = $this->distance(2,9,5,4);

        dd($distance); 


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
