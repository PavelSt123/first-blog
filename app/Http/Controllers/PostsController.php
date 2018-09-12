<?php

namespace App\Http\Controllers;

use App\Http\Controllers\isAuthor;
use App\Post;
use Illuminate\Http\Concerns\hasFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = \App\Post::all();
        if (UsersController::isAdmin()) {
            return view('admin')->with('posts', $posts);
        }
        return view('welcome')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_post');
    }

    private function handleFileUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $fileExtension = $request->file('image')->getClientOriginalExtension();
            $this->filenameToStore = $filename . '_' . time() . '.' . $fileExtension;
            $path = $request->file('image')->storeAs('public/images', $this->filenameToStore);
        }
        else {
            $this->filenameToStore = 'noimage.jpg';
        }        
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:100',
            'body' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->handleFileUpload($request);
        $post= new Post();
        $this->validateData($request);
        $request->validate([
            'dateCreated' => 'required',
        ]);
        $post->title= $request['title'];
        $post->body= $request['body'];
        $post->user_id = Auth::id();
        $post->image = $this->filenameToStore;
        $post->created_at = $request['dateCreated'];
        $post->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        if (! $post = Post::find($id)) {
            return view('errors.404');            
        }
        return view('show_post')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $id)
    {
        $post = Post::find($id);  
        return view('edit_post')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @param  \App\Post  $post->id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $this->handleFileUpload($request);
        $post = Post::find($id);
        $this->validateData($request);
        if (UsersController::isAuthor($post) || UsersController::isAdmin()) {
            $post->body= $request['body'];
            $post->title= $request['title'];
            if ($post->image != 'noimage.jpg' && $request->hasFile('image')) {
                Storage::delete('public/images/' . $post->image);
                $post->image= $this->filenameToStore;
            }
            $post->save();
            return redirect()->action(
                'PostsController@show', ['id' => $post->id]
            )->with('message', 'Post edited!');
        }
        else return back()->with('message', 'You are not the author of this post.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::find($id);
        if (UsersController::isAuthor($post) || UsersController::isAdmin()) {
            if ($post->image != 'noimage.jpg') {
                Storage::delete('public/images/' . $post->image);
            }
            $post->delete();
            return redirect('/')->with('message', 'Post deleted!');
        }
        else return back()->with('message', 'You are not the author of this post.');
    }
}
