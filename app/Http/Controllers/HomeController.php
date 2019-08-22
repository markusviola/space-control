<?php

namespace App\Http\Controllers;

use App\Space;
use App\Type;
use App\User;
use Illuminate\Http\Request;

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
        $user = new User();
        $types = Type::all();
        $spaces = Space::all();

        return view('home', compact('user', 'types', 'spaces'));
    }
}
