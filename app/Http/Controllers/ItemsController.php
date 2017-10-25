<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //get all items from database via model Item
        $items = Items::all();
        //return json object
        return response() ->json($items);
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
        //validate first, Validator class imported above
        $validator = Validator::make($request->all(), [
          'text' => 'required'
        ]);
        if($validator->fails()){
          $response = array('response' => $validator->messages(), 'success'=>false);
          return $response;
        }else{
          //create new item
          $item = new Items;
          $item->text = $request->input('text');
          $item->body = $request->input('body');
          $item->save();

          return response()->json($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //showing single item based on id of item in database
        $item = Items::find($id);
        return response() ->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      //validate first, Validator class imported above
      $validator = Validator::make($request->all(), [
        'text' => 'required'
      ]);
      if($validator->fails()){
        $response = array('response' => $validator->messages(), 'success'=>false);
        return $response;
      }else{
        //find the item to be updated
        $item = Items::find($id);
        $item->text = $request->input('text');
        $item->body = $request->input('body');
        $item->save();

        return response()->json($item);
        //BE SURE TO USE _method for key and PUT for value if using postman desktop app to test api
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
      //find the item to be deleted
      $item = Items::find($id);
      $item->delete();
      //BE SURE TO USE _method for key and DELETE for value if using postman desktop app to test api , NO TEXT AND BODY REQUIRED
      $response = array('response' =>'Item deleted', 'success'=>true);
      return $response;
    }
}
