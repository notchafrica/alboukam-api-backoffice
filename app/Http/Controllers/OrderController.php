<?php

namespace App\Http\Controllers;

use App\Models\DeliverOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(auth()->user()->orders()->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public()
    {
        return response()->json(Order::whereStatus('confirmed')->whereTakenAt(null)->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'details' => ['required'],
            'deliver_to' => ['required'],
            'products' => ['required'],
            'products.*.id' => ['required', 'exists:products,id', 'distinct'],
            'products.*.quantity' => ['required', 'integer']
        ]);

        $order = auth()->user()->orders()->create([
            'details' => $request->details,
            'deliver_to' => $request->to,
            'fee' => 0,
        ]);

        foreach ($request->products as $product) {
            $order->products()->create([
                'product_id' =>  $product['id'],
                'quantity' => $product['quantity']
            ]);
        }

        return response()->json($order->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function take(Request $request, Order $order)
    {
        $r = DeliverOrder::whereOrderId($order->id)->first();

        if ($r) {
            throw ValidationException::withMessages([
                'order' => [trans('already taken')],
            ]);
        }



        $order = auth()->user()->orders()->create([
            'order_id' => $order->id
        ]);

        $order = Order::find($order->order_id);

        $order->taken_at = now();
        $order->save();

        return response()->json($order->refresh());
    }

    public function markAsDelivered(Request $request, Order $order)
    {
        $r = DeliverOrder::whereOrderId($order->id)->first();

        if ($r->delivered_at) {
            throw ValidationException::withMessages([
                'order' => [trans('action unalloyed')],
            ]);
        }

        $r->delivered_at = now();

        $r->save();

        $user = auth()->user();

        $user->credit += ($r->order->fee / 100 * 30);

        $user->save();

        return response()->json($r->refresh());
    }
}
