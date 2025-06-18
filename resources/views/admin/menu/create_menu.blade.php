@extends('admin_root.admin_root')
@section('title', 'Create Main Menu')
@section('content')
    <h1 style="text-align: center">Create Main Menu</h1>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column;" method="post" action="{{route('admin.main_menu.postCreate')}}">
        @csrf
        <div style="display: flex; justify-content: flex-end">
            <div style="margin-right: 10px;">Choose language </div>
            <select name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if(old('lang') == $localeCode) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <hr style="width: 100%">
        <label>Name *</label>
        <input type="text" name="name" placeholder="Name" value="{{old('name')}}" required>
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Link</label>
        <input type="text" name="link" placeholder="Link" value="{{old('link')}}">
        @error('link')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Page (enabled pages)</label>
        <select name="page_id">
            <option value="">-</option>
            @foreach($pages as $page)
                <option value="{{$page->id}}" @if(old('page_id') == $page->id) selected @endif>{{$page->name}} ({{'/' . $page->slug}})</option>
            @endforeach
        </select>
        @error('type')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <button type="submit" style="margin-top: 25px;">Create</button>
    </form>
    <div style="width: 512px;margin: 25px auto;">
        <a href="{{route('admin.main_menu')}}">Main Menu</a>
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
