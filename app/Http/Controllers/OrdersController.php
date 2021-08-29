<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrdersController extends Controller
{
    public function index()
    {
        return Order::with('products')->get();
    }

    public function show(Order $order)
    {
        $order->products;
        return $order;
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        $order->products()->attach($request->product_id);
        $order->products;

        // $adminEmail = env("ADMIN_MAIL_RECEIVER", "boostforu0@gmail.com");

        // \Mail::to($order->email)->send(new \App\Mail\CustomerNewOrder($order));

        // \Mail::to($adminEmail)->send(new \App\Mail\AdminNewOrder($order));

        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order)
    {
        // Log::debug($request->status);
        $order->update($request->all());

        return response()->json($order, 200);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return response()->json($order, 200);
    }

    public function delete(Order $order)
    {
        $order->delete();

        return response()->json(null, 204);
    }
}
