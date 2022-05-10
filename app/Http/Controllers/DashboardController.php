<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        # dashboard
        return view('dashboard');
    }

    public function orders()
    {
        # orders
        return view('orders');
    }
}
