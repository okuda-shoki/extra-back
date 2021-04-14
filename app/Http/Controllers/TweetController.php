<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Tweet::all();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Tweet;
        $item->text = $request->text;
        $item->save();
        return response()->json([
            'message' => 'Created successfully',
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $Tweet)
    {
        $text=DB::table('tweet')->where('text',$Tweet->text)->get();
        $texts=[
            "text"=>$text
        ];
        return response()->json($texts,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $Tweet)
    {
        $item = Tweet::where('id', $Tweet->id)->first();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->save();
        if ($item) {
            return response()->json([
                'message' => $item,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $contact)
    {
        $item = Tweet::where('id', $contact->id)->delete();
        if ($item) {
            return response()->json([
                'message' => $item,
            ], 200);
        } else {
            return response()->json([
                'message' => $item,
            ], 404);
        }
    }
}