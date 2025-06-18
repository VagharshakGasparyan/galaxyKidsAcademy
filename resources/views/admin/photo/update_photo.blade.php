@extends('admin_root.admin_root')
@section('title', 'Update Page')
@section('content')
    <h1 style="text-align: center">Update Page</h1>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column;" method="post" action="{{route('admin.photos.postUpdate', $photo->id)}}" enctype="multipart/form-data">
        @csrf
        <div style="display: flex; justify-content: flex-end">
            <div style="margin-right: 10px;">Choose language </div>
            <select name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <label><input type="checkbox" name="enabled" @if($photo->enabled) checked @endif> Enabled</label>
        @error('enabled')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Title</label>
        <input type="text" name="title" placeholder="Title" value="{{old('title', $photo->title[$lang] ?? '')}}">
        @error('title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Description</label>
        <textarea style="width: 100%;min-width: 100%;max-width: 100%" name="description" rows="7"
                  placeholder="Description">{{old('content', $photo->description[$lang] ?? '')}}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Image * (Dimensions: min 96px, max 1920px, size: max 15mB.)</label>
        <input type="file" name="image" accept="image/jpeg,image/png" placeholder="Image">
        @error('image')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="button" style="width: 20px;" id="del_img">&times;</button>
        <div id="show_image">
            @if($photo->image)
                <input type="hidden" name="old_image" value="{{$photo->image}}">
                <img src="{{asset('storage/' . $photo->image)}}" alt="image" style="width: 100%">
            @endif
        </div>

        <button type="submit" style="margin-top: 25px;">Update</button>
    </form>
    <div style="width: 512px;margin: 25px auto;">
        <a href="{{route('admin.photos')}}">Photos</a>
        <a href="{{route('admin.photos.create')}}">Create Photo</a>
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
            let select_lang = document.querySelector('select[name="lang"]');
            select_lang.addEventListener('input', ()=>{
                // alert(select_lang.value);
                const url = new URL(window.location.href);
                url.searchParams.set('lang', select_lang.value);
                // Go to the new URL (without reloading the page)
                //history.pushState({}, '', url);
                // Or with reloading:
                window.location.href = url.toString();
            });
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
