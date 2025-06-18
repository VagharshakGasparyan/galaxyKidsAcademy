@extends('admin_root.admin_root')
@section('title', 'Dashboard')
@section('content')
    <div style="width: 512px;margin: 0 auto;">
        <h1 style="text-align: center">Show Page</h1>
        <div style="display: flex; justify-content: flex-end">
            <div style="margin-right: 10px;">Choose language </div>
            <select name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <table style="width: 100%;">
            <thead></thead>
            <tbody>
            <tr>
                <td>Big title</td>
                <td><h1>{{$page->big_title[$lang] ?? ''}}</h1></td>
            </tr>
            <tr>
                <td>Medium title</td>
                <td><h2>{{$page->medium_title[$lang] ?? ''}}</h2></td>
            </tr>
            <tr>
                <td>Small title</td>
                <td><h3>{{$page->small_title[$lang] ?? ''}}</h3></td>
            </tr>
            <tr>
                <td>Content</td>
                <td>
                    <div style="white-space: pre-wrap">{{$page->content[$lang] ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td>Image</td>
                <td>
                    @if($page->image)
                        <img src="{{asset('storage/' . $page->image)}}" alt="image" style="width: 100%">
                    @endif
                </td>
            </tr>
            <tr>
                <td>Images</td>
                <td>
                    @foreach($page->images ?? [] as $imageItem)
                        <img src="{{asset('storage/' . $imageItem)}}" alt="imageItem" style="width: 32%">
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
        <div style="width: 512px;margin: 25px auto;">
            <a href="{{route('admin.pages')}}">Pages</a>
            <a href="{{route('admin.pages.update', $page->id)}}">Edit Page</a>
            <a href="{{route('admin.pages.create')}}">Create Page</a>
        </div>


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
        })
    </script>
@endpush
