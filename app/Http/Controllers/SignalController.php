<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signal;
use JWTAuth;

class SignalController extends Controller{
    
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
        return $this->user->signals()->get();
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
            'rank' => 'required | integer',
            'name' => 'required',
            'description' => 'required',
            'gain' => 'required | numeric',
            'trades' => 'required | integer',
            'price' => 'required | numeric',
            'type' => 'required'
        ]);

        $signal = new Signal();
        $signal->rank = $request->rank;
        $signal->name = $request->name;
        $signal->description = $request->description;
        $signal->gain = $request->gain;
        $signal->trades = $request->trades;
        $signal->price = $request->price;
        $signal->type = $request->type;

        if($this->user->signals()->save($signal))
                return response()->json([
                'success' => true,
                'signal' => $signal
            ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, signal couldnt be added'
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
        $signal = $this->user->signals()->find($id);

        if (!$signal){
            return response()->json([
                'success' =>false,
                'message' => 'Sorry, signal with id ' . $id . ' cant be found'
            ], 400);
        }
        return $signal;
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
        $signal = $this->user->signals()->find($id);

        if(!$signal){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, signal with id ' . $id . ' cant be found'
            ], 400);
        }

        $updated = $signal->fill($request->all())
            ->save();

        if($updated){
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, signal cant be updated'
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
        $signal = $this->user->signals()->find($id);

        if(!$signal){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, signal with id' . $id . 'cant be found'
            ], 400);
        }
        if($signal->delete()){
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Signal couldnt be deleted'
            ], 500);
        }
    }
}
