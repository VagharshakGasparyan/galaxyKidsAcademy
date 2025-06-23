<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(): \Illuminate\Contracts\View\View
    {
        return view('admin.login');
    }
    public function logout(): \Illuminate\Http\RedirectResponse
    {
        if(auth()->check()){
            auth()->logout();
        }
        return redirect()->route('admin.login');
    }
    public function logging(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate(
            [
                "email" => "required|email|min:6|exists:users,email",
                "password" => "required|min:8",
            ]
        );
        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)->where('role', 'admin')->first();
        if(!$user){
            return back()->withErrors(['email' => 'Not a correct email']);
        }
        $hashedPassword = $user->password;

        if (!Hash::check($password, $hashedPassword)) {
            return back()->withErrors(['password' => 'Not a correct password']);
        }
        Auth::login($user);
        return redirect()->route('admin.dashboard');
    }
    public function dashboard(): \Illuminate\Contracts\View\View
    {
        return view('admin.dashboard');
    }
    public function account(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        return view('admin.account', compact('user'));
    }
    public function accountPostUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|min:6|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return back();
    }
    public function accountPostUpdatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|required_with:password|same:password',
            'current_password' => 'required|min:8',
        ]);
        $hashedPassword = $user->password;
        $current_password = $request->get('current_password');
        if (!Hash::check($current_password, $hashedPassword)) {
            return back()->withErrors(['current_password' => 'Not a correct password']);
        }
        $hashed_password = Hash::make($request->get('password'));
        $user->update([
            'password' => $hashed_password,
        ]);

        return back();
    }

}
