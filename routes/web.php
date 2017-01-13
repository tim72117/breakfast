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

Route::get('buy', function () {
    return View::make('buy');
});

Route::get('/', 'OrderController@index');
Route::get('orders', 'OrderController@all');
Route::get('materials', 'OrderController@materials');
Route::get('products', 'OrderController@products');
Route::post('checkout', 'OrderController@checkout');


Route::get('products', function () {

    $products =  App\Product::all();

    return ['products' => $products];
});

Route::post('order', function (Illuminate\Http\Request $request) {

    $products = array_reduce($request->input('items'), function ($carry, $item) {
        $carry[$item['id']] = ['amount' => $item['amount']];
        return $carry;
    }, []);

    $total = App\Product::find(array_keys($products))->reduce(function ($carry, $product) use ($products) {
        $carry += $products[$product->id]['amount'] * $product->price;
        return $carry;
    }, 0);

    $no = App\Order::withTrashed()->max('no') ?: 0;
    $taked_at = Carbon\Carbon::now()->addMinutes(10)->toDateTimeString();

    $ordered = App\Order::create(['no' => $no+1, 'total' => $total, 'taked_at' => $taked_at]);

    $ordered->products()->attach($products);

    return ['ordered' => $ordered];
});

Auth::routes();

Route::get('/home', 'HomeController@index');
