@extends('admin_root.admin_root')
@section('title', 'Update Page')
@section('content')
    <h1 style="text-align: center">Update Page</h1>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column;" method="post" action="{{route('admin.pages.postUpdate', $page->id)}}" enctype="multipart/form-data">
        @csrf
        <div style="display: flex; justify-content: flex-end">
            <div style="margin-right: 10px;">Choose language </div>
            <select name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <label><input type="checkbox" name="enabled" @if($page->enabled) checked @endif> Enabled</label>
        @error('enabled')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Slug * (Page Link, can be path or path1/path2)</label>
        <input type="text" name="slug" placeholder="Slug" required value="{{old('slug', $page->slug)}}">
        @error('slug')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Name * (need for Admin)</label>
        <input type="text" name="name" placeholder="Name" required value="{{old('name', $page->name)}}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Page Type</label>
        <select name="type">
            <option value="page" @if(old('type', $page->type) == 'page') selected @endif>Page</option>
        </select>
        @error('type')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Big Title</label>
        <input type="text" name="big_title" placeholder="Big Title" value="{{old('big_title', $page->big_title[$lang] ?? '')}}">
        @error('big_title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Medium Title</label>
        <input type="text" name="medium_title" placeholder="Medium Title" value="{{old('medium_title', $page->medium_title[$lang] ?? '')}}">
        @error('medium_title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Small Title</label>
        <input type="text" name="small_title" placeholder="Small Title" value="{{old('small_title', $page->small_title[$lang] ?? '')}}">
        @error('small_title')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Content</label>
        <textarea style="width: 100%;min-width: 100%;max-width: 100%" name="content" rows="7"
                  placeholder="Content">{{old('content', $page->content[$lang] ?? '')}}</textarea>
        @error('content')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Image (Dimensions: min 96px, max 1920px, size: max 15mB.)</label>
        <input type="file" name="image" accept="image/jpeg,image/png" placeholder="Image">
        @error('image')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="button" style="width: 20px;" id="del_img">&times;</button>
        <div id="show_image">
            @if($page->image)
                <input type="hidden" name="old_image" value="{{$page->image}}">
                <img src="{{asset('storage/' . $page->image)}}" alt="image" style="width: 100%">
            @endif
        </div>
        <hr style="width: 100%">
        <label>Images (Dimensions: min 96px, max 1920px, size: max 15mB.)</label>
        <input type="file" multiple name="images[]" accept="image/jpeg,image/png" placeholder="Images">
        @error('images')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <div>
            @foreach($page->images as $imageIndex => $imageItem)
                <div style="display: inline-block; position: relative;width: 32%">
                    <input type="hidden" name="old_images[{{$imageIndex}}]" value="{{$imageItem}}">
                    <img src="{{asset('storage/' . $imageItem)}}" alt="imageItem" style="width: 100%">
                    <input type="checkbox" name="old_images_checked[{{$imageIndex}}]" style="width: 20px;height: 20px;position: absolute;top:0;right: 0;" checked>
                </div>
            @endforeach
        </div>
        <button type="button" style="width: 20px;" id="del_imgs">&times;</button>
        <div id="show_images"></div>

        <button type="submit" style="margin-top: 25px;">Update</button>
    </form>
    <div style="width: 512px;margin: 25px auto;">
        <a href="{{route('admin.pages')}}">Pages</a>
        <a href="{{route('admin.pages.create')}}">Create Page</a>
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
