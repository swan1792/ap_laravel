<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorePostRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Naming Routing
    // public function testRoute()
    // {
    //     dd('Route is working');
    // }

    public function index()
    {
        $data = Post::orderBy('id', 'desc')->get(); //eloquent model
        // dd($data);//die dump
        return view('index', compact('data'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // $validated = $request->validate
        //     'name' => 'required|unique:posts|max:255',
        //     'description' => 'required',
        // ]);
        // $post = new Post;
        // $post->name=$request->name;
        // $post->description=$request->description;
        // $post->save();

        Post::create([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        return Redirect::to('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id); POST method
        dd($post->categories);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id); Post Method
        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        // $post = Post::findOrFail($id); Post Method
        // $validated = $request->validate([
        //     'name' => 'required|unique:posts|max:255',
        //     'description' => 'required',
        // ]);
        // $post->name=$request->name;
        // $post->description=$request->description;
        // $post->save();

        $post->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return Redirect::to('post');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) //Route Model Binding
    {

        // $post = Post::findOrFail($id)->delete(); Post Method
        $post->delete();
        return Redirect::to('post');
    }
}
