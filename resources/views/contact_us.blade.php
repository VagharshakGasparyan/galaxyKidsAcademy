@extends('root.root')
@section('title', __('contact-us.head_title'))
@section('content')
    <div class="contact-container">
        <div class="left-column">
            <button type="button" class="call-now">{{__('contact-us.telephone')}}</button>
            <div class="map-box">
{{--                <iframe width="600" height="450" loading="lazy" allowfullscreen--}}
{{--                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8&q=121%20E.%20Prospect%20Burbank%20Ca%2091502&zoom=13&maptype=roadmap"></iframe>--}}
                <iframe
                    width="600"
                    height="450"
                    loading="lazy"
                    allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8&q={{$map_llz->value1 ?? '34.1818'}},{{$map_llz->value2 ?? '-118.3080'}}&zoom={{$map_llz->value3 ?? '16'}}&maptype=roadmap">
                </iframe>
            </div>
            <div class="info-box">
                <h2>{{__('contact-us.info.title')}}</h2>
                <p style="white-space: pre-line">{{__('contact-us.info.content')}}</p>
            </div>
        </div>

        <div class="right-column">
            <div class="form-box">
                @if(session()->has('info_message'))
                    <div style="border: 1px solid #07f; color: #07f;border-radius: 10px;font-size: 16px;display: flex;overflow: hidden;">
                        <div style="padding: 10px; background-color: #07f;color: white"><i class="fa fa-info"></i></div>
                        <div style="padding: 10px; flex: 1">{{session()->get('info_message')}}</div>
                    </div>
                @endif
                <h3>{{__('contact-us.form.title')}}</h3>
                <p class="small-text">{{__('contact-us.form.sub_title')}}</p>
                <form method="post" action="{{route('deal')}}">
                    @csrf
                    <div class="row">
                        <div style="flex: 1;">
                            <input type="text" name="first_name" style="width: 100%" placeholder="{{__('contact-us.form.First Name')}} *" required value="{{old('first_name')}}">
                            @error('first_name')
                            <div style="color: red;font-size: 12px;">{{$message}}</div>
                            @enderror
                        </div>
                        <div style="flex: 1;">
                            <input type="text" name="last_name" style="width: 100%" placeholder="{{__('contact-us.form.Last Name')}} *" required  value="{{old('last_name')}}">
                            @error('last_name')
                            <div style="color: red;font-size: 12px;">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div style="flex: 1;">
                            <input type="email" name="email" style="width: 100%" placeholder="{{__('contact-us.form.Email')}} *" required  value="{{old('email')}}">
                            @error('email')
                            <div style="color: red;font-size: 12px;">{{$message}}</div>
                            @enderror
                        </div>
                        <div style="flex: 1;">
                            <input type="tel" name="phone_number" style="width: 100%" placeholder="{{__('contact-us.form.Phone')}} *" required  value="{{old('phone_number')}}">
                            @error('phone_number')
                            <div style="color: red;font-size: 12px;">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <textarea name="comments" placeholder="{{__('contact-us.form.Questions or Comments')}} *" >{{old('comments')}}</textarea>
                    @error('comments')
                    <div style="color: red;font-size: 12px;">{{$message}}</div>
                    @enderror
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
