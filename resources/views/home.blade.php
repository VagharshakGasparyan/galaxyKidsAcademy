@extends('root.root')
@section('title', __('Home'))
@section('content')
    <!-- Hero section -->

    <div class="hero-section-home">
        <div class="hero-content-home">
            <h1>A Solid Foundation</h1>
            <p>For Your Children</p>
            <a href="#" class="btn-home">GET STARTED HERE</a>
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
                    <h3>toddler programs</h3>
                    <p>
                        The toddler age group is where one and
                        two-year-olds learn. We recognize and encourage
                        these differences, and our toddler teaching
                        staff is able to provide a variety of strategies
                        that allow for each child to learn key skills
                        while having fun. Our teachers provide
                        individual attention and independent play that
                        allows for early learning to prosper.
                    </p>
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
                    <h3>preschool programs</h3>
                    <p>
                        Preschool to the learning of two and exciting
                        three and four-year-old child. Our days are
                        filled with a variety of learning opportunities
                        that incorporate individual learning styles and
                        create a passion for academics. Our focus is on
                        playful learning while also developing the
                        social-emotional needs for each child.
                    </p>
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
                    <h3>pre-k programs</h3>
                    <p>
                        Our pre-k degree is designed to prepare children
                        to enter kindergarten prepared for the following
                        academic year. We provide a kindergarten
                        curriculum important to school readiness and all
                        other areas of development. The goal is for your
                        child to enter kindergarten not only problem
                        solving and social skills.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero section end -->

    <!-- Features section -->
    <section class="features-section">
        <div class="features-overlay"></div>
        <div class="container">
            <div class="feature-card">
                <div class="icon-circle yellow-circle">
                            <span class="icon-text"
                            ><i class="fa-solid fa-envelope-open-text"></i
                                ></span>
                </div>
                <div class="card-content">
                    <h4>Our Curriculum</h4>
                    <p>
                        We use the Creative Curriculum for Infants,
                        Toddlers, and Twos. The Creative Curriculum
                        allows teachers to meet the individual learning
                        needs of each child with developmentally
                        appropriate activities.
                    </p>
                </div>
            </div>

            <div class="feature-card">
                <div class="icon-circle dark-circle">
                            <span class="icon-text"
                            ><i class="fa-solid fa-user-graduate"></i
                                ></span>
                </div>
                <div class="card-content">
                    <h4>Admissions</h4>
                    <p>
                        Please call for tuition rates and other
                        enrollment information regarding our daycare
                        facility. We accept DHR approved two-year-old
                        certificates, Head Start, and Bright from the
                        Start.
                    </p>
                </div>
            </div>

            <div class="feature-card">
                <div class="icon-circle dark-circle">
                            <span class="icon-text"
                            ><i class="fa-brands fa-envira"></i
                                ></span>
                </div>
                <div class="card-content">
                    <h4>Our Gallery</h4>
                    <p>
                        Our school believes in offering a fun
                        environment that allows all of our kids to
                        develop, learn, and socialize in a safe and
                        secure environment. See our gallery to learn
                        more.
                    </p>
                </div>
            </div>

            <div class="feature-card">
                <div class="icon-circle yellow-circle">
                            <span class="icon-text"
                            ><i class="fa-regular fa-calendar-check"></i
                                ></span>
                </div>
                <div class="card-content">
                    <h4>Daily Schedules</h4>
                    <p>
                        We offer a variety of daily schedules that allow
                        for the children to develop on their own pace.
                        Please contact us for more information.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->

    <!-- Education section -->
    <section class="education-section">
        <div class="container">
            <h2 class="education-title">A Well Rounded Education</h2>
            <div class="education-content">
                <p>
                    Galaxy Kids Academy strives to provide a quality
                    Early Childhood Education Program filled with
                    carefully chosen staff members, filled with love and
                    compassion for children. We believe that children
                    are our most important resource and that their early
                    childhood experiences are crucial in the development
                    of their future.
                </p>
                <p>
                    The program we pursue is geared toward helping your
                    child develop habits of observation, questioning and
                    listening while building a positive self-esteem. Our
                    staff members are partners with our parents working
                    together to meet both the needs of the children and
                    their families.
                </p>
            </div>
            <div class="education-buttons">
                <a href="#" class="btn-education btn-dark"
                >TUITION & FEES</a
                >
                <a href="#" class="btn-education btn-light-blue"
                >ABOUT US</a
                >
            </div>
        </div>
    </section>

    <!-- Tour section -->
    <section class="tour-section">
        <div class="tour-content-wrapper">
            <div class="tour-text-column">
                <h2 class="tour-title">Take A Tour</h2>
                <p class="tour-subtitle">come see what we're about</p>
                <p class="tour-description">
                    Our role is to supplement, but not take the place
                    of, the primary role of families in providing care
                    for their children. By establishing and maintaining
                    open and ongoing communication with families, we are
                    able to strengthen the ties that connect the home
                    with our center and enhance the individual
                    development of the children in our care.
                </p>
                <a href="#" class="btn-schedule">SCHEDULE TODAY</a>
            </div>
            <div class="tour-image-column"></div>
        </div>
    </section>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
