@extends('root.root')
@section('title', __('gallery.Gallery'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <section class="gallery-section section-divider">
            <h2>Gallery</h2>
            <p class="body-font">
                Galaxy Kids Academy strives to provide an educational
                program to every child enrolled while offering a network
                of support to each family as a whole.
            </p>
            <p class="body-font">
                Our teachers work in partnership with each family to
                identify individual goals and plans for the children.
                The curriculum we implement provides a comprehensive
                program for children and work toward development in the
                areas of communication, gross motor, fine motor,
                problem-solving, and personal-social.
            </p>
        </section>

        <div class="gallery">
            @foreach($photos as $photo)
                <img src="{{asset('storage/' . $photo->image)}}" alt="{{$photo->image}}" class="gallery-item">
            @endforeach
{{--            <img src="{{asset('assets/web/images/gallery-images/1.jpg')}}" alt="Image 1" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/2.jpg')}}" alt="Image 2" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/3.jpg')}}" alt="Image 3" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/4.jpg')}}" alt="Image 4" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/5.jpg')}}" alt="Image 5" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/6.jpg')}}" alt="Image 6" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/7.jpg')}}" alt="Image 7" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/8.jpg')}}" alt="Image 8" class="gallery-item">--}}
{{--            <img src="{{asset('assets/web/images/gallery-images/9.jpg')}}" alt="Image 9" class="gallery-item">--}}
        </div>

        <!-- Slideshow lightbox -->
        <div id="slideshow" class="slideshow">
            <span class="close">&times;</span>
            <img id="slideshow-img" src="" alt="" />
            <div class="nav prev">&#10094;</div>
            <div class="nav next">&#10095;</div>
        </div>

        @include('partials.buttons_container')
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
