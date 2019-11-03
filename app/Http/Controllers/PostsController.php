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
            ->latest()
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
        if (isset($data['address'])) $newPost->address = $data['address'];
        if (isset($data['business_hours'])) $newPost->business_hours = $data['business_hours'];
        if (isset($data['per_hour'])) $newPost->per_hour = $data['per_hour'];
        if (isset($data['notes'])) $newPost->notes = $data['notes'];
        if (isset($data['post_image'])) {
            $newPost->post_image = $data['post_image']
                ->store('uploads', 'public');
        }
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
            'post_image' => 'file|image|max:5000',
            'address' => 'string',
            'business_hours' => 'string',
            'per_hour' => 'numeric',
            'notes' => 'string|alpha_num'
        ]);
    }
}
