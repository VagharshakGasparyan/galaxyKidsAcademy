@extends('admin_root.admin_root')
@section('title', 'Create Main Menu')
@section('content')
    <form style="width: 768px;" method="post" action="{{route('admin.main_menu.postCreate')}}">
        <div class="admin-content-title">
            <a href="{{route('admin.main_menu')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Main Menu</a>
            <h1 class="text-center">Create Main Menu</h1>
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
        <div class="mb-3">
            <label for="main_menu_name" class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" placeholder="Name" id="main_menu_name" value="{{old('name')}}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="main_menu_link" class="form-label">Link</label>
            <input type="text" name="link" class="form-control" placeholder="Link" id="main_menu_link" value="{{old('link')}}">
            @error('link')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="main_menu_page_id" class="form-label">Page</label>
            <select name="page_id" class="form-select" id="main_menu_page_id">
                <option value="">-</option>
                @foreach($pages as $page)
                    <option value="{{$page->id}}" @if(old('page_id') == $page->id) selected @endif>{{$page->name}} ({{'/' . $page->slug}})</option>
                @endforeach
            </select>
            @error('page_id')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-5">
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </form>


@endsection
@push('body_js')
    <script>

    </script>
@endpush
