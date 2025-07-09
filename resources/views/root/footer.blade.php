@php
    use App\Models\MyConfig;
    $pdf1 = MyConfig::where('group_key', 'site')->where('key', 'pdf1')->first();
    $pdf2 = MyConfig::where('group_key', 'site')->where('key', 'pdf2')->first();
@endphp
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h5 class="footer-title">{{__('footer.column_1')}}</h5>
            <ul class="footer-links">
                <li><a href="{{route('home')}}">{{__('footer.Home')}}</a></li>
                <li><a href="{{route('about_us')}}">{{__('footer.About Us')}}</a></li>
                <li><a href="{{route('gallery')}}">{{__('footer.Gallery')}}</a></li>
                <li><a href="{{route('contact_us')}}">{{__('footer.Contact Us')}}</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h5 class="footer-title">{{__('footer.column_2')}}</h5>
            <ul class="footer-links">
                <li><a href="{{route('admissions')}}">{{__('footer.Admissions')}}</a></li>
                <li><a href="{{route('tuitions_fees')}}">{{__('footer.Tuition & Fees')}}</a></li>
                <li><a href="{{route('our_programs')}}">{{__('footer.Our Programs')}}</a></li>
                <li><a href="{{route('parents_corner')}}">{{__('footer.Parents Corner')}}</a></li>
                <li><a href="{{route('privacy_policy')}}">{{__('footer.Privacy Policy')}}</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h5 class="footer-title">{{__('footer.column_3')}}</h5>
            <ul class="footer-links">
                <li>
                    <a href="{{($pdf1->value1 ?? null) ? asset('storage/' . $pdf1->value1) : 'javascript:void(0)'}}"
                        download="{{__('footer.pdf_1')}}" >{{__('footer.pdf_1')}}</a>
                </li>
                <li>
                    <a href="{{($pdf2->value1 ?? null) ? asset('storage/' . $pdf2->value1) : 'javascript:void(0)'}}"
                        download="{{__('footer.pdf_2')}}" >{{__('footer.pdf_2')}}</a>
                </li>
            </ul>
        </div>

        <div class="footer-column footer-social">
            <a href="#" class="social-icon"
            ><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"
            ><i class="fab fa-facebook-f"></i></a>
        </div>
    </div>
</footer>

<section class="copyright-bar">
    <p>{{__('footer.copyright')}}</p>
</section>
