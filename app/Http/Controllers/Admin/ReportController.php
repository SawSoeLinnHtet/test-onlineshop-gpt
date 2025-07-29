<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;

class ReportController extends Controller
{
    public function index()
    {
        // later you’ll build charts / tables here
        return view('admin.reports.index');
    }
}
