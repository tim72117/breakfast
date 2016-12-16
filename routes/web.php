<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return View::make('orders');
});

Route::get('buy', function () {
    return View::make('buy');
});

Route::get('orders', function () {

    $orders =  App\Order::with('products')->get();

    return ['orders' => $orders];
});

Route::get('products', function () {

    $products =  App\Product::all();

    return ['products' => $products];
});

Route::post('checkout', function (Illuminate\Http\Request $request) {

    App\Order::find($request->input('order_id'))->delete();

    $orders =  App\Order::with('products')->get();

    return ['orders' => $orders];
});

Route::post('order', function (Illuminate\Http\Request $request) {

    $total = App\Product::find([$request->input('product_id')])->sum('price');

    $order = App\Order::create(['no' => 5, 'wait' => 10, 'total' => $total]);

    $order->products()->attach($request->input('product_id'), ['amount' => 1]);

    return ['order' => 1];
});
