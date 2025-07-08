@extends('root.root')
@section('title', __('about-us.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <section class="about-us-section section-divider">
            <h2>{{__('about-us.header_1')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('about-us.content_1')}}</p>
        </section>

        <section class="our-mission-section section-divider">
            <h2>{{__('about-us.header_2')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('about-us.content_2')}}</p>
        </section>

        <section class="our-philosophy-section section-divider">
            <h2>{{__('about-us.header_3')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('about-us.content_3')}}</p>
        </section>

        <section class="our-goals-section section-divider">
            <h2>{{__('about-us.header_4')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('about-us.content_4')}}</p>
        </section>

        <section class="our-center-section section-divider">
            <h2>{{__('about-us.header_5')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('about-us.content_5')}}</p>
        </section>

        <section class="our-staff-section">
            <h2>{{__('about-us.header_6')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('about-us.content_6')}}</p>
        </section>

        @include('partials.buttons_container')
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
