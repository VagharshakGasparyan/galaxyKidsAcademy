@extends('root.root')
@section('title', __('parents-corner.head_title'))
@section('content')
    @include('partials.hero_section')

    <div class="container-wrap">
        <section class="parents-corner-section section-divider">
            <h1>Parents Corner</h1>
            <p class="body-font">
                Family involvement, family satisfaction, and shared
                decision making about your child’s experience are
                essential to the Galaxy Kids Academy program. We believe
                the center forms a caring and learning community in
                which families, staff, and children can interact and
                grow. We actively work to support family life and create
                ways to involve families in our program. Family
                involvement is an all-purpose term that encompasses
                family partnership groups and committees, volunteering,
                family education, and special events. We believe the key
                to family involvement is giving families a variety of
                ways to be involved, if they are able, in the life of
                the center.
            </p>
        </section>

        <section class="parents-corner-section section-divider">
            <h2>Family-Teacher Partnerships</h2>
            <p class="body-font">
                The family-teacher partnership at Galaxy Kids Academy
                helps children build a positive attitude toward
                themselves, toward language, literacy, and all other
                areas of the curriculum. Together, we can provide a
                stronger program for your child to foster a lifelong
                love of learning. The best teacher and family
                partnerships are based on frequent opportunities to
                share information. You can strengthen your family’s role
                as your child’s first and most important teacher and
                share in learning by participating in activities at home
                as well as at the center.
            </p>
        </section>

        <section class="parents-corner-section">
            <h2>Family Communication</h2>
            <p class="body-font">
                We are committed to creating a strong home and center
                connection by developing a process of open, honest
                communication with you regarding your child’s
                development and experience at the center. This includes
                a continual exchange of information between you and the
                center staff and management.
            </p>
            <div class="communications">
                <div class="communications-content">
                    <h3>Electronic Communication</h3>
                    <p class="body-font">
                        It is important that everyone who cares for your
                        child has a sense of his or her daily
                        experience, both at home and in the center.
                        Staggered scheduling of staff makes the
                        Electronic Communication System a critical
                        communication link. The emails will give you a
                        sense of your child’s day and keep you informed
                        about his or her experiences and may also
                        include a picture of your child in action.
                        Parents may also send messages to your child’s
                        teacher before arriving at the center to share
                        information about your child’s morning to help
                        with drop off time, making it easier for you to
                        head off to work.
                    </p>
                </div>
                <div class="communications-content">
                    <h3>Postings</h3>
                    <p class="body-font">
                        Bulletin boards are located throughout the
                        center (in the foyer, hallways, and classroom
                        entrances) to communicate news, daily events,
                        staff notes, holiday closing dates, center
                        visitors, etc.
                    </p>
                </div>
                <div class="communications-content">
                    <h3>Lockers</h3>
                    <p class="body-font">
                        When center management or teachers have
                        information to share with all families, this
                        information could be left in your child’s locker
                        for you, e-mailed to you via the center or
                        classroom distribution list, or left on the
                        check-in/out station screen. Check with your
                        center to find out where your mailbox is and
                        please make sure to check it daily.
                    </p>
                </div>
                <div class="communications-content">
                    <h3>Partnership Groups</h3>
                    <p class="body-font">
                        Family Partnership Groups provide an opportunity
                        for you to be part of a forum in your center to
                        discuss center-wide activities, family
                        education, center updates, and much more. Ask
                        center management for more information about the
                        Family Partnership Group and other ways you can
                        become involved.
                    </p>
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
