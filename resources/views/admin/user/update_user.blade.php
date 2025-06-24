@extends('admin_root.admin_root')
@section('title', 'Update User')
@section('content')

    <form style="max-width: 768px;" method="post" action="{{route('admin.users.postUpdate', $user->id)}}" enctype="multipart/form-data">
        <div class="admin-content-title">
            <a href="{{route('admin.users')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Users</a>
            <h1 class="text-center">Update User</h1>
        </div>
        @csrf
        <div class="mb-3">
            <label for="user_name" class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" placeholder="Name" id="user_name" value="{{old('name', $user->name)}}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="user_email" class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" placeholder="Email" id="user_email" value="{{old('email', $user->email)}}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="admin_user_password" class="form-label">New Password</label>
            <div class="position-relative">
                <input type="password" name="password" class="form-control" id="admin_user_password" placeholder="New Password" value="{{old('password')}}">
                <i class="fa fa-eye input-eye"></i>
            </div>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="admin_user_confirm_password" class="form-label">Confirm new Password</label>
            <div class="position-relative">
                <input type="password" name="confirm_password" class="form-control" id="admin_user_confirm_password" placeholder="Confirm Password">
                <i class="fa fa-eye input-eye"></i>
            </div>
            @error('confirm_password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="admin_user_your_password" class="form-label">Your password to confirm (not the User you are updating)</label>
            <div class="position-relative">
                <input type="password" name="your_password" class="form-control" id="admin_user_your_password" placeholder="Your Password">
                <i class="fa fa-eye input-eye"></i>
            </div>
            @error('your_password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="user_role" class="form-label">Role (default admin)</label>
            <select name="role" class="form-select" id="user_role">
                <option value="admin">admin</option>
            </select>
            @error('role')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="user_photo" class="form-label">Photo (Dimensions: min 48px, max 1920px, size: max 15mB.)</label>
            <div class="position-relative">
                <input type="file" name="photo" class="form-control" id="user_photo" accept="image/jpeg,image/png" placeholder="Photo">
                <button type="button" class="btn btn-close input-close" id="del_img"></button>
            </div>

            @error('photo')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <div class="mt-2" id="show_image">
                @if($user->photo)
                    <input type="hidden" name="old_photo" value="{{$user->photo}}">
                    <img src="{{asset('storage/' . $user->photo)}}" alt="image" style="max-width: 100%">
                @endif
            </div>
        </div>

        <div class="mt-5">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>

    </form>

@endsection
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            async function fileToBase64(file) {
                let b64 = await new Promise((resolve) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                });
                return b64;
            }

            let del_img = document.getElementById('del_img');
            let show_image = document.getElementById('show_image');
            let imgInp = document.querySelector('input[type="file"][name="photo"]');
            imgInp.addEventListener('input', async ()=>{
                let file = imgInp.files[0];
                if (file.type.startsWith('image')) {
                    let img = new Image;
                    img.style.maxWidth = '100%';
                    img.src = await fileToBase64(file);
                    show_image.innerHTML = '';
                    show_image.appendChild(img);
                }
            });
            del_img.addEventListener('click', ()=>{
                imgInp.value = null;
                show_image.innerHTML = '';
            });
        });
    </script>
@endpush
