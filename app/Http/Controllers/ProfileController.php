<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUser()
    {
        $user = Auth::user();
        session(['user_id' => $user->id]);
        $user = DB::table("users")
            ->where('users.id', $user->id)
            ->get();
        return view('profile', ['user' => $user]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAdmin()
    {
        $admin = Auth::guard('admin')->user();
        session(['admin_id' => $admin->id]);
        $admin = DB::table("admins")
            ->where('admins.id', $admin->id)
            ->get();
        return view('profile', ['admin' => $admin]);
    }
}
