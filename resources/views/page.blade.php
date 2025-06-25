@extends('root.root')
@section('title', $page->slug)
@section('content')
    <div style="width: 1024px;margin: 25px auto;">
        @if($page->image)
            <div style="display: flex; justify-content: center">
                <img src="{{asset('storage/' . $page->image)}}" alt="image" style="width: 512px; max-width: 100%">
            </div>
        @endif
        @if($page->big_title[app()->getLocale()])
            <h1>{{$page->big_title[app()->getLocale()]}}</h1>
        @endif
        @if($page->medium_title[app()->getLocale()])
            <h2>{{$page->medium_title[app()->getLocale()]}}</h2>
        @endif
        @if($page->small_title[app()->getLocale()])
            <h3>{{$page->small_title[app()->getLocale()]}}</h3>
        @endif
        @if($page->content[app()->getLocale()])
            <div style="white-space: pre-wrap; text-align: justify">{!! $page->content[app()->getLocale()] !!}</div>
        @endif
        <div style="display: flex;flex-wrap: wrap;">
            @foreach($page->images ?? [] as $imageItem)
                <div style="width: 250px;height: 250px;
                background-image: url('{{asset('storage/' . $imageItem)}}'); background-size: cover;margin: 5px;
                border: 2px solid #ddd;border-radius: 5px;"></div>
            @endforeach
        </div>
    </div>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
