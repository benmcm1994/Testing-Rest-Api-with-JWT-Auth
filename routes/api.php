<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//OPEN ROUTES WITHOUT AUTH
Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::get('open', 'DataController@open');
    //testing api remove when testing is over

    
//CLOSED ROUTES REQUIRING AUTH
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::get('closed', 'DataController@closed');

        //////////////////////////////////////
        //GET USER DATA/////////////////////
        /////////////////////////////////////

        Route::get('/users', function () {
            $users = DB::table('users')->latest()->get();
            return $users;
        });


        Route::get('/user/{user}', function ($id) {
            $user = DB::table('users')->find($id);
            return Response::json($user);
        });

        Route::get('/userdetails', function (){
            
            $user = Auth::user();

            return Response::json($user);
        });

        //////////////////////////////////////
        //GET SIGNAL DATA/////////////////////
        /////////////////////////////////////
        Route::get('signals', 'SignalController@index');
        Route::get('signal/{id}', 'SignalController@show');
        Route::post('signals', 'SignalController@store');
        Route::put('signal/{id}', 'SignalController@update');
        Route::delete('signal/{id}', 'SignalController@destroy');

        Route::get('/allsignals', function () {
            //GET ALL SIGNALS - NEEDS ADMIN PRIVI
            $allSignals = DB::table('signals')->latest()->get();
        
            return Response::json($allSignals);
        });

        //////////////////////////////////////
        //GET ACCOUNT DATA/////////////////////
        /////////////////////////////////////

        Route::get('accounts', 'AccountController@index');
        Route::get('account/{id}', 'AccountController@show');
        Route::post('accounts', 'AccountController@store');
        Route::put('account/{id}', 'AccountController@update');
        Route::delete('account/{id}', 'AccountController@destroy');

       // Route::get('/accounts', function () {
        //GET CURRENT USER'S ACCOUNTS
          //  $accounts = DB::table('accounts')->where('user_id', Auth::id())->get();
            
         //   return $accounts;
       // });
        
        //Route::get('/account/{id}', function ($id) {
        //GET EACH ACCOUNT
          //  $account = DB::table('accounts')->find($id);
            
          //  return Response::json($account);
       // });

        //Route::get('/allaccounts', function () {
        //GETS ALL ACCOUNTS
          //  $allAccounts = DB::table('accounts')->latest()->get();
        
        //    return $allAccounts;
        //});


    });




