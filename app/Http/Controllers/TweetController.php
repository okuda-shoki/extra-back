<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    public function get (Request $request)
    {
        $items=DB::table('Tweet')->where('text',$request->text)->get();
        return response()->json([
            'message'=>'User got successfully',
            'data'=>$items
        ],200);
    }

    public function post(Request $request)
    {
        $param=[
            "text"=>$request->text,
        ];
        DB::table('Tweet')->insert($param);
        return response()->json([
            'message'=>'Like created successfully',
            'data'=>$param
        ],200);
    }
    public function destory(Tweet $tweet)
    {
        $item=Tweet::where('id',$tweet->id)->delete();
        if($item){
            return response()->json(
                ['message'=>'Share deleted successfully'],
                200
            );
        }else{
            return response()->json(
                ['message'=>'Share not found'],
                404
            );
        }
    }
}
