<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item; 

class ProductController extends Controller
{
    public function index()
    {
        $items = Item::with('category','user')  
                     ->paginate(15);
        return view('admin.products.index', compact('items'));
    }
}
