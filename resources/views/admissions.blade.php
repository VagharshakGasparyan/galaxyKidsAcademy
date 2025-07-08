@extends('root.root')
@section('title', __('admissions.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <h1 class="h1">{{__('admissions.header')}}</h1>
        <section class="admission-section section-divider">
            <h2>{{__('admissions.sub_header_1')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('admissions.sub_content_1')}}</p>
        </section>

        <section class="admission-section section-divider">
            <h2>{{__('admissions.sub_header_2')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('admissions.sub_content_2')}}</p>
        </section>

        <section class="admission-section">
            <h2>{{__('admissions.sub_header_3')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('admissions.sub_content_3')}}</p>
        </section>

        @include('partials.buttons_container')
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
