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

        return view('spacelist', compact('posts'));
    }

    public function formIndex() {
        $user = new User();
        $types = Type::all();
        $spaces = Space::all();
        $isReserveList = false;

        if (auth()->check() && !auth()->user()->is_admin) {
            $forms = Form::with('type')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        } else {
            $forms = Form::with('type')
                ->latest()
                ->get();
        }

        return view('home',
            compact('user', 'types', 'spaces', 'forms', 'isReserveList'));
    }

}
