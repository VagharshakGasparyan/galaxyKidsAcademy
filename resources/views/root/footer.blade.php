<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h5 class="footer-title">Site Map</h5>
            <ul class="footer-links">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('about_us')}}">About Us</a></li>
                <li><a href="javascript:void(0)">News & Blog</a></li>
                <li><a href="{{route('gallery')}}">Gallery</a></li>
                <li><a href="{{route('contact_us')}}">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h5 class="footer-title">Quick Links</h5>
            <ul class="footer-links">
                <li><a href="{{route('admissions')}}">Admissions</a></li>
                <li><a href="{{route('tuitions_fees')}}">Tuition & Fees</a></li>
                <li><a href="{{route('our_programs')}}">Our Programs</a></li>
                <li><a href="{{route('parents_corner')}}">Parents Corner</a></li>
                <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h5 class="footer-title">Resources</h5>
            <ul class="footer-links">
                <li>
                    <a
                        href="{{asset('assets/web/files/Galaxy-Kids-Academy-Parent-Handbook.pdf')}}"
                        download
                    >Parent Handbook</a
                    >
                </li>
                <li>
                    <a
                        href="{{asset('assets/web/files/Galaxy-Kids-Academy-Employee-Handbook.pdf')}}"
                        download
                    >Employee Handbook</a
                    >
                </li>
            </ul>
        </div>

        <div class="footer-column footer-social">
            <a href="#" class="social-icon"
            ><i class="fab fa-instagram"></i
                ></a>
            <a href="#" class="social-icon"
            ><i class="fab fa-facebook-f"></i
                ></a>
        </div>
    </div>
</footer>

<section class="copyright-bar">
    <p>{{__('footer.copyright')}}</p>
</section>
