<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use JWTAuth;

class AccountController extends Controller
{
  
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->accounts()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'connection' => 'required | integer',
            'name' => 'required',
            'type' => 'required',
            'broker' => 'required',
            'suffix' => 'required',
        ]);

        $account = new account();
        $account->connection = $request->connection;
        $account->name = $request->name;
        $account->type = $request->type;
        $account->broker = $request->broker;
        $account->suffix = $request->suffix;

        if($this->user->accounts()->save($account))
                return response()->json([
                'success' => true,
                'account' => $account
            ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, account couldnt be added'
                ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = $this->user->accounts()->find($id);

        if (!$account){
            return response()->json([
                'success' =>false,
                'message' => 'Sorry, account with id ' . $id . ' cant be found'
            ], 400);
        }
        return $account;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $account = $this->user->accounts()->find($id);

        if(!$account){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, account with id ' . $id . ' cant be found'
            ], 400);
        }

        $updated = $account->fill($request->all())
            ->save();

        if($updated){
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, account cant be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = $this->user->accounts()->find($id);

        if(!$account){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, account with id' . $id . 'cant be found'
            ], 400);
        }
        if($account->delete()){
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'account couldnt be deleted'
            ], 500);
        }
    }
}
