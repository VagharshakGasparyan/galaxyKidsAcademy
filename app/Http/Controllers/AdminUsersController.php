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

        return view('admin.photo.create_user');
    }

    public function postCreate(Request $request): \Illuminate\Http\RedirectResponse
    {
//        dd($request->all());
        request()->validate([
            'title' => 'nullable|min:1|max:10000',
            'description' => 'nullable|min:1|max:1000000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',
        ]);
        $enabled = $request->has('enabled');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $title = [];
        $description = [];
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
            $title[$localeCode] = '';
            $description[$localeCode] = '';
        }
        $title[$lang] = $request->get('title') ?? '';
        $description[$lang] = $request->get('description') ?? '';

        $src_filePath = (new FService())->fileUpload($request->files->get('image'), 'photos');
        $image = $src_filePath['filePath'];

        Photo::create([
            'enabled' => $enabled,
            'image' => $image,
            'title' => $title,
            'description' => $description,
        ]);

        return redirect()->route('admin.photos');
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

    public function show(Request $request, $id): \Illuminate\Contracts\View\View
    {
        $photo = Photo::findOrFail($id);
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        return view('admin.photo.show_photo', compact('photo', 'lang'));
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
