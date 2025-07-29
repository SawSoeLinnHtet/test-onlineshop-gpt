<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1) Always load all categories for the sidebar/cards
        $categories = Category::all();
    
        // 2) Start a fresh Item query
        $query = Item::query();
    
        // 3) If a category was clicked, apply the WHERE
        if ($request->has('category_id')) {
            $query->where('categoryID', $request->category_id);
        }
    
        // 4) Grab the items (filtered or not)
        $items = $query->get();
    
        // 5) Pass both to the view
        return view('Items.index', compact('items','categories'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::findOrFail($id);

        // fetch other items in the same category
        $relatedItems = Item::where('categoryID', $item->categoryID)
                            ->where('id', '<>', $item->id)
                            ->get();
        
        return view('Items.detail', compact('item','relatedItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
