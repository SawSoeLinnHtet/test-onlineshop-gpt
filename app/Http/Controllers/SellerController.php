<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the “Become a Seller” form
    public function applyForm()
    {
        return view('seller.apply');
    }

    // Handle submission
    public function apply(Request $request)
    {
        $request->validate([
            'seller_bio' => 'required|string|max:1000',
        ]);

        auth()->user()->update([
            'seller_bio'    => $request->seller_bio,
            'seller_status' => 'pending',
        ]);

        return redirect()
            ->route('shop.home')
            ->with('success','Application received—pending approval.');
    }

    // (optional) Seller-only dashboard
    public function dashboard()
    {
        return view('seller.dashboard');
    }
}
