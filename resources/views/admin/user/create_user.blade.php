@extends('admin_root.admin_root')
@section('title', 'Create Photo')
@section('content')
    <h1 style="text-align: center">Photos</h1>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column;" method="post" action="{{route('admin.photos.postCreate')}}" enctype="multipart/form-data">
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
        <label>Title</label>
        <input type="text" name="title" placeholder="Title" value="{{old('title')}}">
        @error('title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Description</label>
        <textarea style="width: 100%;min-width: 100%;max-width: 100%" type="text" name="description" rows="7" placeholder="Description">{{old('description')}}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Image *</label>
        <input type="file" name="image" accept="image/jpeg,image/png" placeholder="Image">
        @error('image')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="button" style="width: 20px;" id="del_img">&times;</button>
        <div id="show_image"></div>
        <hr style="width: 100%">
        <button type="submit" style="margin-top: 25px;">Create</button>
    </form>
    <div style="width: 512px;margin: 25px auto;">
        <a href="{{route('admin.photos')}}">Photos</a>
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
            let imgInp = document.querySelector('input[type="file"][name="image"]');
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
            del_img.addEventListener('click', ()=>{
                imgInp.value = null;
                show_image.innerHTML = '';
            });
        });
    </script>
@endpush
