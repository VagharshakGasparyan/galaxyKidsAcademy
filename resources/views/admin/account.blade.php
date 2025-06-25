@extends('admin_root.admin_root')
@section('title', 'Account')
@section('content')
    <div style="max-width: 1024px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Account</h1>
        </div>
        <form class="row"  method="post" action="{{route('admin.account.update')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-lg-6 col-md-12">
                <label for="admin_user_name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="admin_user_name" placeholder="Name" value="{{old('name', $user->name)}}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-lg-6 col-md-12">
                <label for="admin_user_email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="admin_user_email" placeholder="Email" value="{{old('email', $user->email)}}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-lg-6 col-md-12">
                <label for="user_photo" class="form-label">Photo (Dimensions: min 48px, max 1920px, size: max 15mB.)</label>
                <div class="position-relative">
                    <input type="file" name="photo" class="form-control" id="user_photo" accept="image/jpeg,image/png" placeholder="Photo">
                    <button type="button" class="btn btn-close input-close" id="del_img"></button>
                </div>
                @error('photo')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-2" id="show_image">
                    @if($user->photo)
                        <input type="hidden" name="old_photo" value="{{$user->photo}}">
                        <img src="{{asset('storage/' . $user->photo)}}" alt="image" style="max-width: 100%">
                    @endif
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <form class="row mt-5"  method="post" action="{{route('admin.account.update_password')}}">
            @csrf
            <div class="mb-3 col-lg-6 col-md-12">
                <label for="admin_user_password" class="form-label">New Password</label>
                <div class="position-relative">
                    <input type="password" name="password" class="form-control" id="admin_user_password" placeholder="New Password" value="{{old('password')}}">
                    <i class="fa fa-eye input-eye"></i>
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-lg-6 col-md-12">
                <label for="admin_user_confirm_password" class="form-label">Confirm new Password</label>
                <div class="position-relative">
                    <input type="password" name="confirm_password" class="form-control" id="admin_user_confirm_password" placeholder="Confirm Password">
                    <i class="fa fa-eye input-eye"></i>
                </div>
                @error('confirm_password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-lg-6 col-md-12">
                <label for="admin_user_current_password" class="form-label">Current Password</label>
                <div class="position-relative">
                    <input type="password" name="current_password" class="form-control" id="admin_user_current_password" placeholder="Current Password">
                    <i class="fa fa-eye input-eye"></i>
                </div>
                @error('current_password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>

    </div>


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
