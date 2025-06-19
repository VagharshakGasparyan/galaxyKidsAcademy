@extends('admin_root.admin_root')
@section('title', 'Create Page')
@section('content')
    <h1 style="text-align: center">Pages</h1>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column;" method="post" action="{{route('admin.pages.postCreate')}}" enctype="multipart/form-data">
        @csrf
        <div style="display: flex; justify-content: flex-end">
            <div style="margin-right: 10px;">Choose language </div>
            <select name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if(old('lang') == $localeCode) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <label><input type="checkbox" name="enabled" checked> Enabled</label>
        @error('enabled')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Slug * (Page Link, can be path or path1/path2)</label>
        <input type="text" name="slug" placeholder="Slug" required value="{{old('slug')}}">
        @error('slug')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Name * (need for Admin)</label>
        <input type="text" name="name" placeholder="Name" required value="{{old('name')}}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Page Type</label>
        <select name="type">
            <option value="page" @if(old('type') == 'page') selected @endif>Page</option>
        </select>
        @error('type')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Big Title</label>
        <input type="text" name="big_title" placeholder="Big Title" value="{{old('big_title')}}">
        @error('big_title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Medium Title</label>
        <input type="text" name="medium_title" placeholder="Medium Title" value="{{old('medium_title')}}">
        @error('medium_title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Small Title</label>
        <input type="text" name="small_title" placeholder="Small Title" value="{{old('small_title')}}">
        @error('small_title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Content</label>
        <textarea style="width: 100%;min-width: 100%;max-width: 100%" type="text" name="content" rows="7" placeholder="Content">{{old('content')}}</textarea>
        @error('content')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">

        <textarea id="tiny"></textarea>


        <label>Image</label>
        <input type="file" name="image" accept="image/jpeg,image/png" placeholder="Image">
        @error('image')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="button" style="width: 20px;" id="del_img">&times;</button>
        <div id="show_image"></div>
        <hr style="width: 100%">
        <label>Images</label>
        <input type="file" multiple name="images[]" accept="image/jpeg,image/png" placeholder="Images">
        @error('images')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="button" style="width: 20px;" id="del_imgs">&times;</button>
        <div id="show_images"></div>

        <button type="submit" style="margin-top: 25px;">Create</button>
    </form>
    <div style="width: 512px;margin: 25px auto;">
        <a href="{{route('admin.pages')}}">Pages</a>
    </div>

@endsection
@push('body_js')
    <script src="{{asset('assets/js/tinymce.min.js')}}"></script>
@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            tinymce.init({ selector: '#tiny' });
            // console.log(tinymce.get('tiny').getContent());

            async function fileToBase64(file) {
                let b64 = await new Promise((resolve) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                });
                return b64;
            }

            let del_img = document.getElementById('del_img');
            let del_imgs = document.getElementById('del_imgs');
            let show_image = document.getElementById('show_image');
            let show_images = document.getElementById('show_images');
            let imgInp = document.querySelector('input[type="file"][name="image"]');
            let imgsInp = document.querySelector('input[type="file"][name="images[]"]');
            imgInp.addEventListener('input', async ()=>{
                let file = imgInp.files[0];
                if (file.type.startsWith('image')) {
                    let img = new Image;
                    img.style.width = '100%';
                    img.src = await fileToBase64(file);
                    show_image.innerHTML = '';
                    show_image.appendChild(img);
                }
            });
            imgsInp.addEventListener('input', async ()=>{
                show_images.innerHTML = '';
                for(let file of imgsInp.files){
                    if (file.type.startsWith('image')) {
                        let img = new Image;
                        img.style.width = '33%';
                        img.src = await fileToBase64(file);
                        show_images.appendChild(img);
                    }
                }
            });
            del_img.addEventListener('click', ()=>{
                imgInp.value = null;
                show_image.innerHTML = '';
            });
            del_imgs.addEventListener('click', ()=>{
                imgsInp.value = null;
                show_images.innerHTML = '';
            });
        });
    </script>
@endpush
