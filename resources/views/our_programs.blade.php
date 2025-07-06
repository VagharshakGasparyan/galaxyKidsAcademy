@extends('root.root')
@section('title', __('our-programs.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <h1 class="h1">Our Programs</h1>
        <section class="our-programs-section section-divider">
            <h2>Our Programs Toddler Programs</h2>
            <h3 class="programs-h3">(18 months – 3years)</h3>
            <p class="body-font">
                The toddler age group is a diverse one, and each child
                is different. We recognize and encourage these
                differences, and our toddler teaching team’s practice a
                variety of strategies that allow for each child to begin
                defining his/her own sense of independence while
                dependent on the adults caring for and teaching him/her.
                Our toddler classrooms follow a daily routine that is
                consistent yet flexible. The children quickly learn to
                anticipate what will come next in their day and begin to
                demonstrate initiative. The teaching teams plan their
                lessons daily to ensure that they are supporting the
                children’s current interests and developmental progress.
                Observation and assessment provide key insight into the
                needs of the individual children and serve as a
                foundation for goal setting and lesson planning. Toilet
                training is also incorporated into the daily routine for
                the older toddlers who demonstrate interest and
                developmental readiness. Teachers and parents work in
                partnership to develop a toilet training plan for their
                child that is consistent between home and school. Our
                toddler program provides a solid stepping stone into our
                preschool. Toddlers typically begin their transition to
                preschool between 33 and 36 months old. At that time the
                child has many opportunities to visit his/her new
                classroom for short periods of time to become acclimated
                with the larger class size and the preschool routine.
                Once the child is feeling comfortable in his/her new
                setting, the teachers and parents agree upon a date for
                the child to move into the preschool program.
            </p>
        </section>

        <section class="our-programs-section section-divider">
            <h2>Preschool Programs</h2>
            <h3 class="programs-h3">(3 years – 4 years)</h3>
            <p class="body-font">
                Preschool is the beginning of a very exciting time in
                the life of a young child. Our days are filled with a
                variety of learning opportunities that become the
                building blocks for each child’s preparation for
                kindergarten. We focus on developing social skills and
                developing a desire for learning in each child. While it
                feels like “we play all day”, we are very strategic in
                our planning to ensure that our expectations are
                appropriate for the current group of children we are
                working with. Through play the children learn problem
                solving skills, develop initiative, and practice math,
                science, reading, and writing throughout every part of
                the day. Our individualized assessment and planning
                strategies provide a comprehensive preschool program
                that blends into our pre- kindergarten program with a
                smooth transition.
            </p>
        </section>

        <section class="our-programs-section">
            <h2>Pre-Kindergarten Programs</h2>
            <h3 class="programs-h3">(4 years to First Grade)</h3>
            <p class="body-font">
                Our pre-kindergarten program serves children who will be
                entering kindergarten the following fall and are 4 years
                of age. The pre-kindergarten curriculum we implement
                provides for individualized instruction and assessment
                and focuses not only on academics, but also problem
                solving and social skills. We enjoy special events,
                parties, and field trips throughout the school year and
                conclude with a graduation ceremony. Pre-kindergarten is
                a year of tremendous growth and development as the
                four-year olds turn five and become kindergarteners. The
                children transition from our program prepared for
                success in their school years to come.
            </p>
        </section>

        <div class="buttons-container">
            <a href="{{route('contact_us')}}" class="button bg-primary text-white">CONTACT US</a>
        </div>
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
