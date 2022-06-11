<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        return Order::all();
    }

    public function add(Request $request)
    {
        $order = Order::create($request->all());
        return $order;
    }
}
