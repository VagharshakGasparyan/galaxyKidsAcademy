<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at')->paginate(10);
        return view('admin.user.users', compact('users'));
    }
    public function create(): \Illuminate\Contracts\View\View
    {

        return view('admin.user.create_user');
    }

    public function postCreate(Request $request): \Illuminate\Http\RedirectResponse
    {
        request()->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|min:6|unique:users,email',
            'role' => 'nullable|string|in:admin,user',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|required_with:password|same:password',
            'your_password' => 'required|min:8|required_with:password',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=48,min_height=48,max_width=1920,max_height=1920',
        ]);
        if (!Hash::check($request->get('your_password'), auth()->user()->password)) {
            return back()->withErrors(['your_password' => 'Not a correct password']);
        }
        $password = $request->get('password');
        $photo = $request->files->get('photo') ?? null;
        if($photo){
            $src_filePath = (new FService())->fileUpload($photo, 'users');
            $photo = $src_filePath['filePath'];
        }

        User::create([
            'name' => $request->get('name'),
            'photo' => $photo,
            'email' => $request->get('email'),
            'role' => $request->get('role') ?? 'admin',
            'password' => Hash::make($password),
        ]);

        return redirect()->route('admin.users');
    }

    public function update($id): \Illuminate\Contracts\View\View
    {
        $user = User::findOrFail($id);
        return view('admin.user.update_user', compact('user'));
    }

    public function postUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        request()->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|min:6|unique:users,email,' . $user->id,
            'role' => 'nullable|string|in:admin,user',
            'password' => 'nullable|min:8',
            'confirm_password' => 'nullable|min:8|required_with:password|same:password',
            'your_password' => 'nullable|min:8|required_with:password',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=48,min_height=48,max_width=1920,max_height=1920',
        ]);
        $role = $request->get('role') ?? 'admin';

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

        $updates = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $role,
            'photo' => $photo,
        ];
        $password = $request->get('password');
        $your_password = $request->get('your_password');
        if ($password && $your_password){
            if (!Hash::check($your_password, auth()->user()->password)) {
                return back()->withErrors(['your_password' => 'Not a correct password']);
            }
            $updates['password'] = Hash::make($password);
        }

        $user->update($updates);

        return back();
    }

    public function show($id): \Illuminate\Contracts\View\View
    {
        $user = User::findOrFail($id);

        return view('admin.user.show_user', compact('user'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        /**
         * hint
         * Page::where('id', $id)->delete() not working for delete files
         * use age::find($id)->delete();
         */

        if(auth()->user()->id == $id) {
            return back()->withErrors(['user' => 'You can\'t delete yourself.']);
        }
        if(User::where('id', $id)->exists()){
            User::find($id)->delete();
        }

        return back();
    }
}
