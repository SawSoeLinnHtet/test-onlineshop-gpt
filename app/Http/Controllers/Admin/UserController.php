<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // paginate so the table stays snappy
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'categoryID');
    }

}
