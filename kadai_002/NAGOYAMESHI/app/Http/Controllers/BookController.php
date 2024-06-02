<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    public function create(Request $request, Shop $shop)
    {
        $user = Auth::User();

        $time = Carbon::createFromDate($shop->start_time)->format('H:i');

        return view('shops.books.create', compact('shop', 'time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop)
    {

        $book = new book();
        $book->user_id = Auth::user()->id;
        $book->shop_id = $request->input('shop_id');
        $book->book_date = $request->input('book_date');
        $book->book_time = $request->input('book_time');
        $book->book_number = $request->input('book_number');

        $year = Carbon::parse($request->book_date)->format('Y');
        $mon = Carbon::parse($request->book_date)->format('m');
        $date = Carbon::parse($request->book_date)->format('d');
        $hour = Carbon::parse($request->book_time)->format('H');
        $minute = Carbon::parse($request->book_time)->format('m');
        $sec = Carbon::parse($request->book_time)->format('i');

        $validate_data = Carbon::create($year, $mon, $date, $hour, $minute, $sec);
        if ($validate_data->isFuture()) {
            $book->save();
            return redirect()->route('shops.show', $shop->id)->with('flash_message','予約が完了しました。詳細はMypageから確認ができます。');
        } else {
            return back()->with('error','入力された時間では予約ができません。再度入力してください。');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function cancel(Shop $shop, Book $book)
    {
        $user = Auth::user();

        $book->delete();

        return to_route('mypage.book')->with('flash_message','予約をキャンセル削除しました。');
    }
}
