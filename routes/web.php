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

    $orders = App\Order::with('products')->get();

    return ['orders' => $orders];
});

Route::get('materials', function () {

    $materials = App\Order::with('products.materials')->get()->reduce(function ($carry, $order) {
        $order->products->each(function ($product) use ($carry) {
            foreach ($product->materials as $material) {
                $carry[$material->id]->amount += $product->pivot->amount;
            }
        });
        return $carry;
    }, App\Material::all()->keyBy('id'))->values();

    return ['materials' => $materials];
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
