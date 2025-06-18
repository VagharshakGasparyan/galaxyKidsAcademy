@extends('admin_root.admin_root')
@section('title', 'Create Main Menu')
@section('content')
    <h1 style="text-align: center">Create Main Menu</h1>
    <form style="width: 512px;margin: 0 auto;display: flex;flex-direction: column;" method="post" action="{{route('admin.main_menu.postUpdate', $menuItem->id)}}">
        @csrf
        <div style="display: flex; justify-content: flex-end">
            <div style="margin-right: 10px;">Choose language </div>
            <select name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <hr style="width: 100%">
        <label>Name *</label>
        <input type="text" name="name" placeholder="Name" value="{{old('name', $menuItem->name[$lang])}}" required>
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Link</label>
        <input type="text" name="link" placeholder="Link" value="{{old('link', $menuItem->link)}}">
        @error('link')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <label>Page (enabled pages)</label>
        <select name="page_id">
            <option value="">-</option>
            @foreach($pages as $page)
                <option value="{{$page->id}}" @if(old('page_id', $menuItem->page_id) == $page->id) selected @endif>{{$page->name}} ({{'/' . $page->slug}})</option>
            @endforeach
        </select>
        @error('type')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <hr style="width: 100%">
        <button type="submit" style="margin-top: 25px;">Update</button>
    </form>
    <div style="width: 512px;margin: 25px auto;">
        <a href="{{route('admin.main_menu')}}">Main Menu</a>
    </div>

@endsection
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
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
        });
    </script>
@endpush
