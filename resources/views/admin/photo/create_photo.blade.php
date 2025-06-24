@extends('admin_root.admin_root')
@section('title', 'Create Photo')
@section('content')

    <form style="max-width: 768px;" method="post" action="{{route('admin.photos.postCreate')}}" enctype="multipart/form-data">
        <div class="admin-content-title">
            <a href="{{route('admin.photos')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Photos</a>
            <h1 class="text-center">Create Photo</h1>
        </div>
        @csrf
        <div style="display: flex; justify-content: flex-end;align-items: center;">
            <div style="margin-right: 10px;">Choose language </div>
            <select class="form-select" style="width: unset" name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if(old('lang') == $localeCode) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <hr style="width: 100%">
        <div class="form-check mb-3">
            <input class="form-check-input" name="enabled" type="checkbox" value="" id="photo_enabled" checked>
            <label class="form-check-label" for="photo_enabled">
                Enabled
            </label>
            @error('enabled')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Title" id="photo_title" value="{{old('title')}}">
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo_description" class="form-label">Description</label>
            <textarea type="text" name="description" class="form-control" rows="5" placeholder="Description" id="photo_description" >{{old('description')}}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo_image" class="form-label">Image * (Dimensions: min 96px, max 1920px, size: max 15mB.)</label>
            <div class="position-relative">
                <input type="file" name="image" class="form-control" id="photo_image" accept="image/jpeg,image/png" placeholder="Photo">
                <button type="button" class="btn btn-close input-close" id="del_img"></button>
            </div>
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2" id="show_image"></div>
        </div>
        <div class="mt-5">
            <button type="submit" class="btn btn-primary">Create</button>
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
            let imgInp = document.querySelector('input[type="file"][name="image"]');
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
