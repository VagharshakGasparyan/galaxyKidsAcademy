@extends('root.root')
@section('title', __('contact-us.head_title'))
@section('content')
    <div class="contact-container">
        <div class="left-column">
            <button type="button" class="call-now">{{__('contact-us.telephone')}}</button>
            <div class="map-box">
                <iframe
                    src="https://maps.google.com/maps?q=6543%20Lankershim%20Blvd,%20North%20Hollywood,%20CA%2091606&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0"
                    allowfullscreen
                ></iframe>
            </div>
            <div class="info-box">
                <h2>{{__('contact-us.info.title')}}</h2>
                <p style="white-space: pre-line">{{__('contact-us.info.content')}}</p>
            </div>
        </div>

        <div class="right-column">
            <div class="form-box">
                <h3>{{__('contact-us.form.title')}}</h3>
                <p class="small-text">{{__('contact-us.form.sub_title')}}</p>
                <form>
                    <div class="row">
                        <input type="text" placeholder="{{__('contact-us.form.First Name')}}*" required >
                        <input type="text" placeholder="{{__('contact-us.form.Last Name')}}*" required >
                    </div>
                    <div class="row">
                        <input type="email" placeholder="{{__('contact-us.form.Email')}}*" required >
                        <input type="tel" placeholder="{{__('contact-us.form.Phone')}}*" required >
                    </div>
                    <textarea placeholder="{{__('contact-us.form.Questions or Comments')}}*" ></textarea>
                    <button type="submit">{{__('contact-us.form.SUBMIT')}}</button>
                </form>
            </div>
            <div class="text-box">
                <h2>{{__('contact-us.explanation.title')}}</h2>
                <p style="white-space: pre-line">{{__('contact-us.explanation.content')}}</p>
            </div>
        </div>
    </div>

@endsection
@push('body_js')
    <script>

    </script>
@endpush
