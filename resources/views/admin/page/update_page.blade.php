@extends('admin_root.admin_root')
@section('title', 'Update Page')
@section('content')
    <form style="max-width: 768px;" method="post" action="{{route('admin.pages.postUpdate', $page->id)}}" enctype="multipart/form-data">
        <div class="admin-content-title">
            <a href="{{route('admin.pages')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Pages</a>
            <h1 class="text-center">Update Page</h1>
        </div>
        @csrf
        <div style="display: flex; justify-content: flex-end;align-items: center;">
            <div style="margin-right: 10px;">Choose language </div>
            <select class="form-select" style="width: unset" name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <hr style="width: 100%">
        <div class="form-check mb-3">
            <input class="form-check-input" name="enabled" type="checkbox" value="" id="page_enabled" @if($page->enabled) checked @endif>
            <label class="form-check-label" for="page_enabled">
                Enabled
            </label>
            @error('enabled')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="page_slug" class="form-label">Slug * (Page Link, can be path or path1/path2)</label>
            <input type="text" name="slug" class="form-control" placeholder="Slug" id="page_slug" value="{{old('slug', $page->slug)}}" required>
            @error('slug')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="page_name" class="form-label">Name * (need for Admin)</label>
            <input type="text" name="name" class="form-control" placeholder="Slug" id="page_name" value="{{old('name', $page->name)}}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="page_type" class="form-label">Page Type</label>
            <select name="type" class="form-select" id="page_type">
                <option value="page" @if(old('type', $page->type) == 'page') selected @endif>Page</option>
            </select>
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="page_big_title" class="form-label">Big Title</label>
            <input type="text" name="big_title" class="form-control" placeholder="Big Title" id="page_big_title" value="{{old('big_title', $page->big_title[$lang] ?? '')}}">
            @error('big_title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="page_medium_title" class="form-label">Medium Title</label>
            <input type="text" name="medium_title" class="form-control" placeholder="Medium Title" id="page_medium_title" value="{{old('medium_title', $page->medium_title[$lang] ?? '')}}">
            @error('medium_title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="page_small_title" class="form-label">Small Title</label>
            <input type="text" name="small_title" class="form-control" placeholder="Small Title" id="page_small_title" value="{{old('small_title', $page->small_title[$lang] ?? '')}}">
            @error('small_title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="photo_content" class="form-label">Content</label>
            <textarea type="text" name="content" class="form-control" rows="5" placeholder="Content" id="photo_content" >{{old('content', $page->content[$lang] ?? '')}}</textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <textarea id="tiny"></textarea>

        <div class="mb-3 mt-3">
            <label for="page_image" class="form-label">Image (Dimensions: min 96px, max 1920px, size: max 15mB.)</label>
            <div class="position-relative">
                <input type="file" name="image" class="form-control" id="page_image" accept="image/jpeg,image/png" placeholder="Image">
                <button type="button" class="btn btn-close input-close" id="del_img"></button>
            </div>
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2" id="show_image">
                @if($page->image)
                    <input type="hidden" name="old_image" value="{{$page->image}}">
                    <img src="{{asset('storage/' . $page->image)}}" alt="image" style="max-width: 100%">
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label for="page_images" class="form-label">Images (Dimensions: min 96px, max 1920px, size: max 15mB.)</label>
            <div class="position-relative">
                <input type="file" multiple name="images[]" class="form-control" id="page_images" accept="image/jpeg,image/png" placeholder="Images">
                <button type="button" class="btn btn-close input-close" id="del_imgs"></button>
            </div>
            @error('images')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="row align-items-center">
                @foreach($page->images as $imageIndex => $imageItem)
                    <div class="col-lg-4 col-md-6 col-sm-12 position-relative">
                        <input type="hidden" name="old_images[{{$imageIndex}}]" value="{{$imageItem}}">
                        <img src="{{asset('storage/' . $imageItem)}}" alt="imageItem" style="padding: 15px;max-width: 100%">
                        <input type="checkbox" name="old_images_checked[{{$imageIndex}}]" style="width: 25px;height: 25px;position: absolute;top:5px;right: 5px;" checked>
                    </div>
                @endforeach
            </div>
            <div class="row align-items-center mt-2" id="show_images"></div>
        </div>

        <div class="mt-5">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

@endsection
@push('head_js')
    <script src="{{asset('assets/js/tinymce.min.js')}}"></script>
@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            tinymce.init({ selector: '#tiny' });

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
                        img.classList.add('col-lg-4');
                        img.classList.add('col-md-6');
                        img.classList.add('col-sm-12');
                        img.style.padding = '15px';
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
