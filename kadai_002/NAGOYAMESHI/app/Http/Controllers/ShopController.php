<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 引数にRequest $requestを追加することにより、渡された値をindexアクション内で使用できるようになる
    public function index(Request $request, Shop $shop, Category $categroy)
    {
        $total_shop_count = Shop::all()->count();

        $shop_keyword = $request->input('shop_keyword');
        $category_keyword = $request->input('category_keyword');

        $query = Shop::query();
        if (!empty($category_keyword) && !empty($shop_keyword)) {
            $query->where('name', 'LIKE','%'.$shop_keyword.'%')->where('category_id', "=", $category_keyword);
            $shop_count = $query->count();
            $shops = $query->sortable()->paginate(15);
        } elseif (empty($category_keyword) && !empty($shop_keyword)) {
            $query->where('name', 'LIKE','%'.$shop_keyword.'%');
            $shop_count = $query->count();
            $shops = $query->sortable()->paginate(15);
        } elseif (!empty($category_keyword) && empty($shop_keyword)) {
            $query->where('category_id', "=", $category_keyword);
            $shop_count = $query->count();
            $shops = $query->sortable()->paginate(15);
        } elseif (empty($category_keyword) && empty($shop_keyword)) {
            $shops = $query->sortable()->paginate(15);
            $shop_count = $query->count();
        } else {
            $shops = $query->sortable()->paginate(15);
            $shop_count = $query->count();
        }

        $categories = Category::all();

        $reviews_avgScore = $shop->reviews()->avg('score');
        $reviews_round_avgScore = round($reviews_avgScore * 2) / 2;

        return view('shops.index', compact('categroy', 'shops', 'total_shop_count', 'shop_count', 'categories', 'shop_keyword', 'category_keyword', 'reviews_round_avgScore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->category_id = $request->input('category_id');
        $shop->lower_price = $request->input('lower_price');
        $shop->upper_price = $request->input('upper_price');
        $shop->start_time = $request->input('start_time');
        $shop->close_time = $request->input('close_time');
        $shop->regular_holiday = $request->input('regular_holiday');
        $shop->postal_code = $request->input('postal_code');
        $shop->address = $request->input('address');
        $shop->phone = $request->input('phone');
        $shop->save();
 
        return to_route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, User $user)
    {
        $user = Auth::user();
        
        $categories = Category::all();
        $reviews = $shop->reviews()->latest('updated_at')->paginate(5);
  
        $reviews_avgScore = $shop->reviews()->avg('score');
        $reviews_round_avgScore = round($reviews_avgScore * 2) / 2;

        $reviews_count = $shop->reviews()->count();
        $favorites_count = $shop->favorites()->count();
        
        return view('shops.show', compact('shop', 'categories', 'reviews', 'reviews_round_avgScore', 'reviews_count', 'favorites_count', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return to_route('shops.index');
    }

    public function favorite(Shop $shop)
    {
        Auth::user()->togglefavorite($shop);

        return back();
    }
}
