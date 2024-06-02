<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Review;

class ToppageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $shops = Shop::all();

        $new_shops = Shop::orderBy('created_at', 'desc')->take(6)->get();

        return view('toppage.index', compact('categories', 'new_shops', 'shops'));
    }
}
