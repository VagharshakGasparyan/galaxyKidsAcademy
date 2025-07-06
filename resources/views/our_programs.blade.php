@extends('root.root')
@section('title', __('our-programs.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <h1 class="h1">{{__('our-programs.header')}}</h1>
        <section class="our-programs-section section-divider">
            <h2>{{__('our-programs.sub_big_header_1')}}</h2>
            <h3 class="programs-h3">{{__('our-programs.sub_header_1')}}</h3>
            <p class="body-font" style="white-space: pre-line">{{__('our-programs.sub_content_1')}}</p>
        </section>

        <section class="our-programs-section section-divider">
            <h2>{{__('our-programs.sub_big_header_2')}}</h2>
            <h3 class="programs-h3">{{__('our-programs.sub_header_2')}}</h3>
            <p class="body-font" style="white-space: pre-line">{{__('our-programs.sub_content_2')}}</p>
        </section>

        <section class="our-programs-section">
            <h2>{{__('our-programs.sub_big_header_3')}}</h2>
            <h3 class="programs-h3">{{__('our-programs.sub_header_3')}}</h3>
            <p class="body-font" style="white-space: pre-line">{{__('our-programs.sub_content_3')}}</p>
        </section>

        <div class="buttons-container">
            <a href="{{route('contact_us')}}" class="button bg-primary text-white">{{__('bottom_buttons.contact_us')}}</a>
        </div>
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
