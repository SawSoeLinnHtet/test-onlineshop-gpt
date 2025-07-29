<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class SellerController extends Controller
{
    // Show all pending seller applications
    public function index()
    {
        $users = User::where('seller_status','pending')
                     ->orderBy('created_at')
                     ->paginate(15);

        return view('admin.sellers.pending', compact('users'));
    }

    // Approve a pending seller
    public function approve(User $user)
    {
        $user->update([
            'seller_status' => 'approved',
            'is_seller'     => true,
        ]);

        return back()->with('success','Seller approved.');
    }

    // Reject (ban) a pending seller
    public function ban(User $user)
    {
        $user->update([
            'seller_status' => 'rejected',
        ]);

        return back()->with('success','Application rejected.');
    }
}
