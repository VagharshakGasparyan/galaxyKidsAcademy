@extends('root.root')
@section('title', $page->slug)
@section('content')
    <div class="container-wrap">
        <section class="gallery-section">
            @if($page->image)
                <div style="display: flex; justify-content: center">
                    <img src="{{asset('storage/' . $page->image)}}" alt="image" style="width: 512px; max-width: 100%"  class="gallery-item">
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
        </section>

        <div class="gallery">
            @foreach($page->images ?? [] as $imageItem)
                <img src="{{asset('storage/' . $imageItem)}}" alt="{{$imageItem}}" class="gallery-item">
            @endforeach
        </div>
        <div id="slideshow" class="slideshow">
            <span class="close">&times;</span>
            <img id="slideshow-img" src="" alt="" />
            <div class="nav prev">&#10094;</div>
            <div class="nav next">&#10095;</div>
        </div>
    </div>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
