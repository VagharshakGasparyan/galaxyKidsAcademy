@extends('admin_root.admin_root')
@section('title', 'Dashboard')
@section('content')
    <div style="width: 512px;margin: 0 auto;">
        <h1 style="text-align: center">Show Photo</h1>
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
                <td>Title</td>
                <td><h1>{{$photo->title[$lang] ?? ''}}</h1></td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <div style="white-space: pre-wrap">{{$photo->description[$lang] ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td>Image</td>
                <td>
                    @if($photo->image)
                        <img src="{{asset('storage/' . $photo->image)}}" alt="image" style="width: 100%">
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
        <div style="width: 512px;margin: 25px auto;">
            <a href="{{route('admin.photos')}}">Photos</a>
            <a href="{{route('admin.photos.update', $photo->id)}}">Edit Photo</a>
            <a href="{{route('admin.photos.create')}}">Create Photo</a>
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
