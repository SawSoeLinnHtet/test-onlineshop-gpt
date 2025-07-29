<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','seller']);
    }

    public function index()
    {
        // Later: load the seller’s products/orders here
        return view('seller.dashboard');
    }
}
