<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function deleteUser(Request $request) {
        if ($request->isMethod('post')) {
            $user_id = $request->session()->get('user_id');
    
            $user = User::find($user_id);
            $user->delete();
    
            Auth::logout();
            $request->session()->flush();
    
            return redirect('/')->with('deleteUser', 'User account deleted.');
        }
    }    
    
    public function deleteAdmin(Request $request) {
        if ($request->isMethod('post')) {
            $admin_id = $request->session()->get('admin_id');
            
            $admin = Admin::find($admin_id);
            $admin->delete();
                
            Auth::logout();
            $request->session()->flush();
                
            return redirect('/')->with('deleteAdmin', 'Admin account deleted.');
        }
    }
      
}
