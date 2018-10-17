<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//OPEN ROUTES WITHOUT AUTH
Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::get('open', 'DataController@open');
    
//CLOSED ROUTES REQUIRING AUTH
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::get('closed', 'DataController@closed');

        Route::get('/users', function () {
            $users = DB::table('users')->latest()->get();
            return $users;
        });

        Route::get('/user/{user}', function ($id) {
            $user = DB::table('users')->find($id);
            return Response::json($user);
        });

        Route::get('/signals', function () {

            $signals = DB::table('signals')->latest()->get();
        
            return $signals;
        });
        
        Route::get('/signal/{id}', function ($id) {
        
            $signal = DB::table('signals')->find($id);
            
            return Response::json($signal);
        });
        
        Route::get('/accounts', function () {
        
            $accounts = DB::table('accounts')->latest()->get();
        
            return $accounts;
        });
        
        Route::get('/account/{id}', function ($id) {
        
            $account = DB::table('accounts')->find($id);
            
            return Response::json($account);
        });

    });




