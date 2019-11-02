<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return view('admin.posts', compact('user'));
        } else abort(404);
    }

    public function getPosts()
    {
        $posts = Post::with([])
            ->where('user_id', auth()->id())
            ->get();
        return $posts;
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
    public function store()
    {
        $data = $this->validateRequest();
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->user_id = auth()->id();
        $newPost->address = $data['address'];
        $newPost->business_hours = $data['business_hours'];
        $newPost->per_hour = $data['per_hour'];
        $newPost->notes = $data['notes'];
        $newPost->post_image = $data['post_image']
            ->store('uploads', 'public');
        $newPost->save();

        return $newPost;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    private function validateRequest() {
        return request()->validate([
            'title' => 'required|max:100',
            'post_image' => 'nullable|file|image|max:5000',
            'address' => 'nullable|string',
            'business_hours' => 'nullable|string',
            'per_hour' => 'nullable|numeric',
            'notes' => 'nullable|string|alpha_num'
        ]);
    }
}
