<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Tweet::all();
        return response()->json([
            'message'=>'OK',
            'data'=>$items
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item=new Tweet;
        $item->text=$request->text;
        $item->save();
        return response()->json([
            'message'=>'Created successfully',
            'data'=>$item
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        $item=Tweet::where('id',$tweet->id)->firt();
        if($tweet){
            return response()->json([
                'message'=>'OK',
                'data'=>$item
            ],200);
        }else{
            return response()->json([
                'message'=>'Not found',
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        $item=Tweet::where('id',$tweet->id)->first();

        $item->text=$request->text;
        $item->save();
        if($item){
            return response()->json([
                'message'=>'Not found',
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $item=Tweet::where('id',$tweet->id)->delete();
        if($item){
            return response()->json([
                'message'=>'Deleted successfully',
            ],200);
        }else{
            return response()->json([
                'message'=>'Not found',
            ],404);
        }
    }
}
