<?php

namespace App\Http\Controllers;

use App\Form;
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
        $user = new User();
        $types = Type::all();
        $spaces = Space::all();
        $forms = Form::all();
        $formsByUser = collect();

        if (Auth::check()) {
            $formsByUser = $forms->filter(function ($form) {
                if ($form->user_id == Auth::user()->id) {
                    return true;
                }
            });
        }

        return view('home',
            compact('user', 'types', 'spaces', 'forms', 'formsByUser'));
    }
}
