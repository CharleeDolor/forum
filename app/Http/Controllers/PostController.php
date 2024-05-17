<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        // Retrieve posts from the database
        $posts = Post::all();

        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function store(Request $request){
        //create an instance of the Post model and save the data
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = rand(1, 5);

        $post->save();

        return response()->json([
            'data' => $post,
            'message' => 'Post created', 
            'method' => 'POST'], 
        201);
    }

    public function show($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::with('user')->where('id', $id)->firstorFail();
        return response()->json([
            'data' => $post,
            'method' => 'GET'
        ], 200);
    }

    public function edit($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        try {
            //code...
            return response()->json([
                'data' => $post,
                'message' => 'Post found',
                'method' => 'GET'
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Something went wrong. Please try again',
                'method' => 'GET'
            ], 201);
        }

    }

    public function update(Request $request, $id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        try {
            //code...
            return response()->json([
                'data' => $post,
                'message' => 'Post edited successfully',
                'method' => 'PUT'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong. Please try again',
                'method' => 'PUT'
            ], 201);
        }
    }

    public function destroy($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        $post->delete();
        try {
            //code...
            return response()->json([
                'data' => $post,
                'message' => 'Post deleted successfully',
                'method' => 'DELETE'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong. Please try again',
                'method' => 'DELETE'
            ], 201);
        }
    }

}
