<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/users', function () {

    $users = DB::table('users')->latest()->get();

    return view('users.index', compact('users'));
});

Route::get('/user/{user}', function ($id) {

    $user = DB::table('users')->find($id);
    
    return view('users.show', compact('user'));
});

Route::get('/signals', function () {

    $signals = DB::table('signals')->latest()->get();

    return view('signals.index', compact('signals'));
});

Route::get('/signal/{id}', function ($id) {

    $signal = DB::table('signals')->find($id);
    
    return view('signals.show', compact('signal'));
});

Route::get('/accounts', function () {

    $accounts = DB::table('accounts')->latest()->get();

    return view('accounts.index', compact('accounts'));
});

Route::get('/account/{id}', function ($id) {

    $account = DB::table('accounts')->find($id);
    
    return view('accounts.show', compact('account'));
});
