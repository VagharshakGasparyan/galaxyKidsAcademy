@php
$mainMenu = \App\Models\MainMenu::whereNull('parent_id')->orderBy('order', 'asc')->get();
$locale = app()->getLocale();
@endphp

<header>
    <div id="logo" class="logo-is-desktop">
        <img
            src="{{asset('assets/web/images/main/logo-removebg-preview.png')}}"
            alt=""
            class="logo_img"
        />
    </div>
    <div class="site_header">
        <div class="header_top">
            <div class="social_icons_uxis">
                <ul class="social_icons">
                    <li class="social-icon">
                        <a href="javascript:void(0)" target="_blank" rel="external"><i class="fa-brands fa-facebook-f"></i></a>
                    </li>
                    <li class="social-icon">
                        <a href="javascript:void(0)" target="_blank" rel="external"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                </ul>
                <div class="icon-uxis-phone">{{__('header.phone_text')}}
                    <span><strong><a href="javascript:void(0)">{{__('header.phone_number')}}</a></strong></span>
                </div>
            </div>

            <!-- Language Switcher with Single Flag -->

            <div class="language-switcher">
                <div class="login-register">
                    <div class="HeaderMenu-link-wrap">
                        <a href="#" class="HeaderMenu-link HeaderMenu-link--sign-in">
                            Sign in
                        </a>
                        <a href="#" class="HeaderMenu-link HeaderMenu-link--sign-up">
                            Sign up
                        </a>
                    </div>
                </div>

                <button class="language-trigger" aria-label="Language menu">
                    <span class="flag-icon fi {{['en' => 'fi-us', 'hy' => 'fi-am'][$locale]}}"></span>
                    <span class="dropdown-arrow"></span>
                </button>
                <div class="language-dropdown">
                    <ul class="language-list">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
{{--                            <option value="{{$localeCode}}">{{$properties['name']}}</option>--}}
                            <li class="language-item @if($locale == $localeCode) active @endif ">
                                <a href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" data-lang="{{$localeCode}}">
                                    <span class="flag-icon fi {{['en' => 'fi-us', 'hy' => 'fi-am'][$localeCode]}}"></span>
                                    {{$properties['name']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="header_bottom">
            <div class="header">
                <div class="container-bottom">
                    <div class="row-wrap">
                        <div class="nav-wrap">
                            <ul class="nav-list">
                                @foreach($mainMenu as $menuIndex => $menuItem)
                                    @include('root.main_menu_item', ['item' => $menuItem, 'list_is_tablet' => $menuIndex >= count($mainMenu) / 2])
                                @endforeach
                            </ul>
                        </div>

                        <div class="nav-wrap">
                            <ul class="nav-list">
                                @foreach($mainMenu as $menuIndex => $menuItem)
                                    @if($menuIndex >= count($mainMenu) / 2)
                                        @include('root.main_menu_item', ['item' => $menuItem])
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="hamburger">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div id="logo-is-desktop">
                        <img src="{{asset('assets/web/images/main/logo-removebg-preview.png')}}"
                            alt=""
                            class="logo_img">
                    </div>
                    <div class="burger-phone">
                        <a href="#"
                        ><i class="fa-solid fa-phone-volume"></i></a>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </div>
    </div>
</header>


{{--<header style="border: 1px solid black">--}}
{{--    <h1 style="text-align: center">Header</h1>--}}
{{--    @if(request()->route()->getName() == 'home')--}}
{{--        <div>Home</div>--}}
{{--    @endif--}}
{{--    <div style="display: flex;justify-content: center;">--}}
{{--        @foreach($mainMenu as $menuItem)--}}
{{--            @include('root.main_menu_item', ['item' => $menuItem])--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</header>--}}
