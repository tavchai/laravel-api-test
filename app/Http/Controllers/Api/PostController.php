<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = Post::all();
        return response()->json(['data'=>$post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {  
        
        request()->validate([
            'title'=>'required',
            'content'=>'required'
        ]);  
        
        $data = $post->create([
            'title'=> request('title'),
            'content'=> request('content')
        ]);

        return response()->json(['data'=>$data]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    { 
        return response()->json(['data'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        // 
        request()->validate([
            'title'=>'required',
            'content'=>'required'
        ]); 
        
        $succ = $post->update([
            'title'=> request('title'),
            'content'=> request('content')
        ]);

        return response()->json(['status'=>$succ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
        $succ = $post->delete();

        return response()->json(['status'=>$succ]);
    }

    public function gettitle(Request $request){
        $post = Post::where('title','like','%'.$request->name.'%')
            ->orderByDESC('id')
            ->get();
        return response()->json([
            'data'=>$post
        ]);
    }

  
}
