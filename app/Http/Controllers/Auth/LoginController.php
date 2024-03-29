<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\User;

class LoginController extends Controller
{
    /*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function showUserLoginForm()
    {
        return view('auth.login', ['url' => 'user']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $admin = Admin::where('email', $request->email)->first();
            $admin_name = $admin->name;
            session(['admin_name' => $admin_name]);
            $admin_id = $admin-> id;
            session(['admin_id' => $admin_id]);
            return redirect()->route('home.admin', ['id' => $admin_id]);
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $user = User::where('email', $request->email)->first();
            $user_name = $user->name;
            session(['user_name' => $user_name]);
            $user_id = $user-> id;
            session(['user_id' => $user_id]);
            return redirect()->route('home.user', ['id' => $user_id]);
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    


    public function logout()
    {
        Session::flush(); 
        Auth::logout(); 
        return redirect()->route('home')->with('message', 'Logged out successfully.'); 
    }
    
}
