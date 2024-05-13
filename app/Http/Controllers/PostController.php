<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    // // Define imageMap variable at the class level
    // private $imageMap;

    // public function __construct()
    // {
    //     // Define the imageMap array in the constructor
    //     $this->imageMap = [
    //         'jkdshfkjsdghfjids' => 'images/default_img.png',
    //         'Commodi ab hic repellat.' => 'images/default_img.png',
    //         'Commodi ab hic repellat.' => 'images/default_img.png',
    //         'Officia illum reiciendis sapiente ea doloremque deserunt.' => 'images/default_img.png',
    //         'Corrupti laborum et aut ut.' => 'images/default_img.png',
    //         'Sequi deleniti maiores ab unde.' => 'images/default_img.png',
    //         'Velit autem quae iure commodi quis magni ducimus.' => 'images/default_img.png',
    //         'Cupiditate aut fugit at impedit sit suscipit.' => 'images/default_img.png',
    //         'Quos labore officia deserunt quod.' => 'images/default_img.png',
    //         'Minima autem quasi magnam.' => 'images/default_img.png',
    //         'Nam voluptatem natus ab nisi eos repellat veniam.' => 'images/default_img.png',
    //         'Harry Potter and the Sorcerers Stone' => 'images/HarryPotter.jpg',
    //         // Add more mappings as needed
    //     ];
    // }

    public function index()
    {

        $imageMap = [
            'The Fault in Our Stars' => 'images/The_Fault_In_Our_Stars.jpg',
            'Commodi ab hic repellat.' => 'images/default_img.png',
            'The Magnificent River under the Mountain' => 'images/default_img.png',
            'Corrupti laborum et aut ut.' => 'images/default_img.png',
            'Sequi deleniti maiores ab unde.' => 'images/default_img.png',
            'Velit autem quae iure commodi quis magni ducimus.' => 'images/default_img.png',
            'Cupiditate aut fugit at impedit sit suscipit.' => 'images/default_img.png',
            'Quos labore officia deserunt quod.' => 'images/default_img.png',
            'Minima autem quasi magnam.' => 'images/default_img.png',
            'Nam voluptatem natus ab nisi eos repellat veniam.' => 'images/default_img.png',
            'Harry Potter and the Sorcerers Stone' => 'images/HarryPotter.jpg',
            // Add more mappings as needed
        ];

        // Retrieve posts from the database
        $posts = Post::all();

        // Pass both posts and imageMap to the view
        return view('posts.index', compact('posts', 'imageMap'));

        // return view('posts.index', ['posts' => Post::all()]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        //create an instance of the Post model and save the data
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = rand(1, 5);


        $post->save();
        return redirect('/posts');
    }

    public function show($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::with('user')->where('id', $id)->firstorFail();
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect('/posts');
    }

    public function destroy($id){
        // the firstOrFail() method will throw an exception if the post is not found
        $post = Post::where('id', $id)->firstOrFail();
        $post->delete();
        return redirect('/posts');
    }

}
