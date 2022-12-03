<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\League;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) { //a user is logged in
            return redirect()->route('home');
        }
        return view('auth.login');
    }  
      
    public function login(Request $request)
    {   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')
                        ->withSuccess('Signed in');
        }
        return redirect()->route('auth.login.index')->withErrors(['incorrect' => 'Désolé, votre mot de passe est incorrect.']);
    }

    public function create()
    {
        if (auth()->check()) { //a user is logged in
            return redirect()->route('home');
        }
        return view('auth.register');
    }
      
    public function store(UserRequest $request)
    {           
        $data = $request->all();
        $check = User::create([
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password'))
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')
                        ->withSuccess('Signed in');
        }

        return redirect("home")->withSuccess('You have signed-in');
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect()->route('auth.login.index');
    }
    
    public function home()
    {
        $userId = Auth::user()->id;
        $leagues = League::where('admin_id', $userId)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('home', ['leagues' => $leagues]);
    }
}