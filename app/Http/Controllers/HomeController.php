<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorePostRequest;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            // Send a test email
            Mail::raw('Hello World', function ($msg) {
                $msg->to('swan@gmail.com')->subject('Test Email');
            });
        } catch (\Exception $e) {
            // Debugging purpose if email fails
            dd('Mail Error: ' . $e->getMessage());
        }

        // Fetch posts for the authenticated user
        $data = Post::where('user_id', auth()->id())->orderBy('id', 'desc')->get();

        return view('index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // Validate and store the post
        $validated = $request->validated();
        $validated['user_id'] = auth()->id(); // Assign the logged-in user's ID
        Post::create($validated);

        return redirect()->route('post.index')->with('status', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Check if the user is authorized to view this post
        $this->authorize('view', $post);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Ensure the authenticated user is the owner of the post
        if ($post->user_id != auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        // Validate and update the post
        $validated = $request->validated();
        $post->update($validated);

        return redirect()->route('post.index')->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Ensure the authenticated user is the owner of the post
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        return redirect()->route('post.index')->with('status', 'Post deleted successfully!');
    }
}
