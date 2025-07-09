@extends('root.root')
@section('title', __('home.head_title'))
@section('content')
    <!-- Hero section -->
    <div class="hero-section-home" style=" @if($home_top_image->value1 ?? null) background-image: url('{{asset('storage/' . $home_top_image->value1)}}'); @endif " >
        <div class="hero-content-home">
            <h1>{{__('home.header_section_text')}}</h1>
            <p>{{__('home.header_section_sub_text')}}</p>
            <a href="{{route('contact_us')}}" class="btn-home">{{__('home.header_section_button_text')}}</a>
        </div>
    </div>

    <section class="programs-section">
        <div class="blue-bar"></div>
        <div class="container">
            <div class="program-card">
                <div class="program-image">
                    <img
                        src="{{asset('assets/web/images/cute-little-girl-painted-hands-600nw-527001838.webp')}}"
                        alt="Toddler programs"
                    />
                </div>
                <div class="program-content">
                    <h3>{{__('home.programs.header_1')}}</h3>
                    <p>{{__('home.programs.content_1')}}</p>
                </div>
            </div>

            <div class="program-card">
                <div class="program-image">
                    <img
                        src="{{asset('assets/web/images/infants-toddlers-topic-landing-page-tile_tcm7-311876.jpg')}}"
                        alt="Preschool programs"
                    />
                </div>
                <div class="program-content">
                    <h3>{{__('home.programs.header_2')}}</h3>
                    <p>{{__('home.programs.content_2')}}</p>
                </div>
            </div>

            <div class="program-card">
                <div class="program-image">
                    <img
                        src="{{asset('assets/web/images/child_school-3.jpg')}}"
                        alt="Pre-K programs"
                    />
                </div>
                <div class="program-content">
                    <h3>{{__('home.programs.header_3')}}</h3>
                    <p>{{__('home.programs.content_3')}}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero section end -->

    <!-- Features section -->
    <section class="features-section" style=" @if($home_middle_image->value1 ?? null) background-image: url('{{asset('storage/' . $home_middle_image->value1)}}'); @endif ">
        <div class="features-overlay"></div>
        <div class="container">
            <div class="feature-card">
                <div class="icon-circle yellow-circle">
                    <span class="icon-text"><i class="fa-solid fa-envelope-open-text"></i></span>
                </div>
                <div class="card-content">
                    <h4>{{__('home.card.header_1')}}</h4>
                    <p>{{__('home.card.content_1')}}</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="icon-circle dark-circle">
                     <span class="icon-text"><i class="fa-solid fa-user-graduate"></i></span>
                </div>
                <div class="card-content">
                    <h4>{{__('home.card.header_2')}}</h4>
                    <p>{{__('home.card.content_2')}}</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="icon-circle dark-circle">
                     <span class="icon-text"><i class="fa-brands fa-envira"></i></span>
                </div>
                <div class="card-content">
                    <h4>{{__('home.card.header_3')}}</h4>
                    <p>{{__('home.card.content_3')}}</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="icon-circle yellow-circle">
                     <span class="icon-text"><i class="fa-regular fa-calendar-check"></i></span>
                </div>
                <div class="card-content">
                    <h4>{{__('home.card.header_4')}}</h4>
                    <p>{{__('home.card.content_4')}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->

    <!-- Education section -->
    <section class="education-section">
        <div class="container">
            <h2 class="education-title">{{__('home.education.title')}}</h2>
            <div class="education-content">
                <p style="white-space: pre-line">{{__('home.education.content')}}</p>
            </div>
            <div class="education-buttons">
                <a href="{{route('tuitions_fees')}}" class="btn-education btn-dark">{{__('home.button.TUITION & FEES')}}</a>
                <a href="{{route('about_us')}}" class="btn-education btn-light-blue">{{__('home.button.ABOUT US')}}</a>
            </div>
        </div>
    </section>

    <!-- Tour section -->
    <section class="tour-section">
        <div class="tour-content-wrapper">
            <div class="tour-text-column">
                <h2 class="tour-title">{{__('home.tour.title')}}</h2>
                <p class="tour-subtitle">{{__('home.tour.sub_title')}}</p>
                <p class="tour-description">{{__('home.tour.content')}}</p>
                <a href="{{route('contact_us')}}" class="btn-schedule">{{__('home.button.SCHEDULE TODAY')}}</a>
            </div>
            <div class="tour-image-column" style=" @if($home_bottom_image->value1 ?? null) background-image: url('{{asset('storage/' . $home_bottom_image->value1)}}'); @endif "></div>
        </div>
    </section>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
