@extends('root.root')
@section('title', __('parents-corner.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <section class="parents-corner-section section-divider">
            <h1>{{__('parents-corner.header')}}</h1>
            <h2>{{__('parents-corner.sub_header_1')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_1')}}</p>
        </section>

        <section class="parents-corner-section section-divider">
            <h2>{{__('parents-corner.sub_header_2')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_2')}}</p>
        </section>

        <section class="parents-corner-section">
            <h2>{{__('parents-corner.sub_header_3')}}</h2>
            <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_3')}}</p>
            <div class="communications">
                <div class="communications-content">
                    <h3>{{__('parents-corner.sub_header_4')}}</h3>
                    <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_4')}}</p>
                </div>
                <div class="communications-content">
                    <h3>{{__('parents-corner.sub_header_5')}}</h3>
                    <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_5')}}</p>
                </div>
                <div class="communications-content">
                    <h3>{{__('parents-corner.sub_header_6')}}</h3>
                    <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_6')}}</p>
                </div>
                <div class="communications-content">
                    <h3>{{__('parents-corner.sub_header_7')}}</h3>
                    <p class="body-font" style="white-space: pre-line">{{__('parents-corner.sub_content_7')}}</p>
                </div>
            </div>
        </section>

        @include('partials.buttons_container')
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
