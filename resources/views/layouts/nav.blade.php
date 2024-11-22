@php
$menus = DB::table('menus')->get();
$menu_arr = array();
@endphp

@foreach($menus as $row)
    @php
        $menu_arr[$row->menu_name] = $row->menu_status;
    @endphp
@endforeach

<!-- Start Navbar Area -->
<div class="navbar-area" id="stickymenu">

    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="" class="logo">
            <img src="{{ asset('uploads/'.$g_setting->logo) }}" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('uploads/'.$g_setting->logo) }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        @if($menu_arr['Home'] == 'Show')
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">{{ MENU_HOME }}</a>
                        </li>
                        @endif

                        @if($menu_arr['About'] == 'Show')
                        <li class="nav-item">
                            <a href="{{ route('front.about') }}" class="nav-link ">{{ MENU_ABOUT }}</a>
                        </li>
                        @endif

                        @if($menu_arr['Services'] == 'Show')
                        <li class="nav-item">
                            <a href="{{ route('front.services') }}" class="nav-link ">{{ MENU_SERVICES }}</a>
                        </li>
                        @endif

                        @if($menu_arr['Shop'] == 'Show')
                        <li class="nav-item">
                            <a href="{{ route('front.shop') }}" class="nav-link ">{{ MENU_SHOP }}</a>
                        </li>
                        @endif

                        @if($menu_arr['Blog'] == 'Show')
                        <li class="nav-item">
                            <a href="{{ route('front.blogs') }}" class="nav-link ">{{ MENU_BLOG }}</a>
                        </li>
                        @endif

                        @php
                            $dynamic_pages = DB::table('dynamic_pages')->get();
                        @endphp

                        @if(
                        ($menu_arr['Career'] == 'Hide') &&
                        ($menu_arr['Project'] == 'Hide') &&
                        ($menu_arr['Photo Gallery'] == 'Hide') &&
                        ($menu_arr['Video Gallery'] == 'Hide') &&
                        ($menu_arr['FAQ'] == 'Hide') &&
                        ($menu_arr['Team Members'] == 'Hide') &&
                        (!$dynamic_pages)
                        )

                        @else
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link dropdown-toggle">{{ MENU_PAGES }}</a>
                            <ul class="dropdown-menu">

                                @if($menu_arr['Career'] == 'Show')
                                <li class="nav-item">
                                    <a href="{{ route('front.career') }}" class="nav-link">{{ MENU_CAREER }}</a>
                                </li>
                                @endif

                                @if($menu_arr['Project'] == 'Show')
                                <li class="nav-item">
                                    <a href="{{ route('front.projects') }}" class="nav-link">{{ MENU_PROJECTS }}</a>
                                </li>
                                @endif

                                @if($menu_arr['Photo Gallery'] == 'Show')
                                <li class="nav-item">
                                    <a href="{{ route('front.photo_gallery') }}" class="nav-link">{{ MENU_PHOTO_GALLERY }}</a>
                                </li>
                                @endif

                                @if($menu_arr['Video Gallery'] == 'Show')
                                <li class="nav-item">
                                    <a href="{{ route('front.video_gallery') }}" class="nav-link">{{ MENU_VIDEO_GALLERY }}</a>
                                </li>
                                @endif

                                @if($menu_arr['FAQ'] == 'Show')
                                <li class="nav-item">
                                    <a href="{{ route('front.faq') }}" class="nav-link">{{ MENU_FAQ }}</a>
                                </li>
                                @endif

                                @if($menu_arr['Team Members'] == 'Show')
                                <li class="nav-item">
                                    <a href="{{ route('front.team_members') }}" class="nav-link">{{ MENU_TEAM_MEMBERS }}</a>
                                </li>
                                @endif

                                @foreach($dynamic_pages as $row)
                                    <li class="nav-item">
                                        <a href="{{ url('page/'.$row->dynamic_page_slug) }}" class="nav-link">{{ $row->dynamic_page_name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        @endif


                        @if($menu_arr['Contact'] == 'Show')
                        <li class="nav-item">
                            <a href="{{ route('front.contact') }}" class="nav-link ">{{ MENU_CONTACT }}</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
