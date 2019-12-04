<?php

namespace App\Http\Controllers;

use App\Form;
use App\Post;
use App\Space;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with([])
            ->latest()
            ->get();

        return view('spacelist',
            compact('posts'));
    }
}
