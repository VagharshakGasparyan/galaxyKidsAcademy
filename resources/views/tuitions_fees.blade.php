@extends('root.root')
@section('title', __('tuitions-fees.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <h1 class="h1">{{__('tuitions-fees.header')}}</h1>
        <section class="tuition-fee-section section-divider">
            <h2>{{__('tuitions-fees.sub_header_1')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('tuitions-fees.sub_content_1')}}</p>
        </section>

        <section class="tuition-fee-section section-divider">
            <h2>{{__('tuitions-fees.sub_header_2')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('tuitions-fees.sub_content_2')}}</p>
        </section>

        <section class="tuition-fee-section">
            <h2>{{__('tuitions-fees.sub_header_3')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('tuitions-fees.sub_content_3')}}</p>
            <div class="body-font">
                <a class="body-font-link" target="_blank" href="{{__('tuitions-fees.sub_content_3_link')}}">{{__('tuitions-fees.sub_content_3_link_name')}}</a>
            </div>
        </section>

        @include('partials.buttons_container')

    </div>
@endsection
@push('body_js')
    <script>

    </script>
@endpush
