<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $user = auth()->user();
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|min:6|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=48,min_height=48,max_width=1920,max_height=1920',
        ]);

        $photo = null;
        if($request->files->get('photo')){
            $src_filePath = (new FService())->fileUpload($request->files->get('photo'), 'users');
            $filePath = $src_filePath['filePath'];
            $photo = $filePath;
            if($user->photo){
                Storage::disk('public')->delete($user->photo);
            }
        }elseif ($request->has('old_photo')){
            $photo = $user->photo;
        }elseif($user->photo){
            Storage::disk('public')->delete($user->photo);
        }

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'photo' => $photo,
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

    public function deal(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|min:6',
            'phone_number' => 'required|min:9',
            'comments' => 'required|min:10|max:500',
        ]);
        $email = $request->get('email');
        if(Deal::where('email', $email)->where('status', Deal::STATUS_PENDING)->exists()){
            return back()->withErrors(['email' => 'You already have a submitted deal with this email.']);
        }

        Deal::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'comments' => $request->get('comments'),
        ]);

        session()->flash('info_message', 'Deal has been created successfully.');

        return back();

    }

}
