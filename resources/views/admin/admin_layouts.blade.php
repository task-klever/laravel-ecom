<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Panel</title>

    @include('admin.includes.styles')

    @include('admin.includes.scripts')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        @php
        $logged_user_role_id = Auth::guard('admin')->user()->role_id;
        $url = Request::path();
        $conName = explode('/',$url);
        @endphp

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
            <div class="sidebar-brand-text mx-3">Admin Panel</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Dashboard -->
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard</span>

            </a>
        </li>

        @php $arr_one = array(); @endphp
        @if($logged_user_role_id!=1)
            @php
                $row = array();
                $access_data = DB::table('role_permissions')
        ->join('role_pages', 'role_permissions.role_page_id', 'role_pages.id')
        ->where('role_id', $logged_user_role_id)
        ->get();
            @endphp
            @foreach($access_data as $row)
                @php
                    if($row->access_status == 1):
                    $arr_one[] = $row->page_title;
                    endif;
                @endphp
            @endforeach
        @endif


        @if($logged_user_role_id!=1)

            @if($conName[1] == 'setting')
                @if(!in_array('General Settings', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'page')
                @if(!in_array('Page Settings', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'role')
                @if(!in_array('Admin User Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'translation')
                @if(!in_array('Translation Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'footer')
                @if(!in_array('Footer Columns', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'slider')
                @if(!in_array('Sliders', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'category'||$conName[1] == 'blog'||$conName[1] == 'comment')
                @if(!in_array('Blog Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'dynamic-page')
                @if(!in_array('Dynamic Pages', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'menu')
                @if(!in_array('Menu Manage', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'project')
                @if(!in_array('Project', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'job')
                @if(!in_array('Career Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'photo-gallery')
                @if(!in_array('Photo Gallery', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'video-gallery')
                @if(!in_array('Video Gallery', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'product'||$conName[1] == 'shipping'||$conName[1] == 'coupon')
                @if(!in_array('Product Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'order')
                @if(!in_array('Order Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'customer')
                @if(!in_array('Customer Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'why-choose')
                @if(!in_array('Why Choose Us', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'service')
                @if(!in_array('Service', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'testimonial')
                @if(!in_array('Testimonial', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'team-member')
                @if(!in_array('Team Member', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'faq')
                @if(!in_array('FAQ', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'email-template')
                @if(!in_array('Email Template', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'subscriber')
                @if(!in_array('Subscriber Section', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

            @if($conName[1] == 'social-media')
                @if(!in_array('Social Media', $arr_one))
                    <script>window.location = "{{ url('admin/dashboard') }}";</script>
                @endif
            @endif

        @endif



        <!-- General Settings -->
        @php if( in_array('General Settings', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/setting/general/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
                <i class="fas fa-cog"></i>
                <span>General Settings</span>
            </a>
            <div id="collapseSetting" class="collapse {{ Request::is('admin/setting/general/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.general_setting.logo') }}">Logo</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.favicon') }}">Favicon</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.loginbg') }}">Login Background</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.topbar') }}">Top Bar</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.banner') }}">Banner</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.footer') }}">Footer</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.sidebar') }}">Sidebar</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.color') }}">Color</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.preloader') }}">Preloader</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.stickyheader') }}">Sticky Header</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.googleanalytic') }}">Google Analytic</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.googlerecaptcha') }}">Google Recaptcha</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.tawklivechat') }}">Tawk Live Chat</a>
                    <a class="collapse-item" href="{{ route('admin.general_setting.cookieconsent') }}">Cookie Consent</a>
                </div>
            </div>
        </li>
        @endif


        <!-- Page Settings -->
        @php if( in_array('Page Settings', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/page/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePageSettings" aria-expanded="true" aria-controls="collapsePageSettings">
                <i class="fas fa-paste"></i>
                <span>Page Settings</span>
            </a>
            <div id="collapsePageSettings" class="collapse {{ Request::is('admin/page/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.page_home.edit') }}">Home</a>
                    <a class="collapse-item" href="{{ route('admin.page_about.edit') }}">About</a>
                    <a class="collapse-item" href="{{ route('admin.page_service.edit') }}">Service</a>
                    <a class="collapse-item" href="{{ route('admin.page_shop.edit') }}">Shop</a>
                    <a class="collapse-item" href="{{ route('admin.page_blog.edit') }}">Blog</a>
                    <a class="collapse-item" href="{{ route('admin.page_project.edit') }}">Project</a>
                    <a class="collapse-item" href="{{ route('admin.page_faq.edit') }}">FAQ</a>
                    <a class="collapse-item" href="{{ route('admin.page_team.edit') }}">Team Member</a>
                    <a class="collapse-item" href="{{ route('admin.page_photo_gallery.edit') }}">Photo Gallery</a>
                    <a class="collapse-item" href="{{ route('admin.page_video_gallery.edit') }}">Video Gallery</a>
                    <a class="collapse-item" href="{{ route('admin.page_contact.edit') }}">Contact</a>
                    <a class="collapse-item" href="{{ route('admin.page_career.edit') }}">Career</a>
                    <a class="collapse-item" href="{{ route('admin.page_term.edit') }}">Term</a>
                    <a class="collapse-item" href="{{ route('admin.page_privacy.edit') }}">Privacy</a>
                    <a class="collapse-item" href="{{ route('admin.page_other.edit') }}">Other</a>
                </div>
            </div>
        </li>
        @endif



        <!-- Admin Users Section -->
        @php if( in_array('Admin User Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/role/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminUser" aria-expanded="true" aria-controls="collapseAdminUser">
                <i class="fas fa-user-secret"></i>
                <span>Admin User Section</span>
            </a>
            <div id="collapseAdminUser" class="collapse {{ Request::is('admin/role/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.role.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('admin.role.user') }}">Users</a>
                </div>
            </div>
        </li>
        @endif



        <!-- Translation Section -->
        @php if( in_array('Translation Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/translation/front/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTranslation" aria-expanded="true" aria-controls="collapseTranslation">
                <i class="fas fa-user-secret"></i>
                <span>Translation Section</span>
            </a>
            <div id="collapseTranslation" class="collapse {{ Request::is('admin/translation/front/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.translation.front') }}">Front End</a>
                </div>
            </div>
        </li>
        @endif



        <!-- Footer Columns -->
        @php if( in_array('Footer Columns', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/footer/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.footer.index') }}">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Footer Columns</span>
            </a>
        </li>
        @endif




        <!-- Sliders -->
        @php if( in_array('Sliders', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/slider/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.slider.index') }}">
                <i class="fas fa-sliders-h"></i>
                <span>Sliders</span>
            </a>
        </li>
        @endif



        <!-- Blog Section -->
        @php if( in_array('Blog Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/category/*')||Request::is('admin/blog/*')||Request::is('admin/comment/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true" aria-controls="collapseBlog">
                <i class="fas fa-cubes"></i>
                <span>Blog Section</span>
            </a>
            <div id="collapseBlog" class="collapse {{ Request::is('admin/category/*')||Request::is('admin/blog/*')||Request::is('admin/comment/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.category.index') }}">Categories</a>
                    <a class="collapse-item" href="{{ route('admin.blog.index') }}">Blogs</a>
                    <a class="collapse-item" href="{{ route('admin.comment.approved') }}">Approved Comments</a>
                    <a class="collapse-item" href="{{ route('admin.comment.pending') }}">Pending Comments</a>
                </div>
            </div>
        </li>
        @endif



        <!-- Dynamic Pages -->
        @php if( in_array('Dynamic Pages', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/dynamic-page/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dynamic_page.index') }}">
                <i class="fas fa-cube"></i>
                <span>Dynamic Pages</span>
            </a>
        </li>
        @endif

        <!-- Menu Manage -->
        @php if( in_array('Menu Manage', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/menu/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.menu.index') }}">
                <i class="fas fa-bars"></i>
                <span>Menu Manage</span>
            </a>
        </li>
        @endif

        <!-- Project -->
        @php if( in_array('Project', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/project/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.project.index') }}">
                <i class="fas fa-umbrella"></i>
                <span>Project</span>
            </a>
        </li>
        @endif

        <!-- Career Section -->
        @php if( in_array('Career Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/job/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCareer" aria-expanded="true" aria-controls="collapseCareer">
                <i class="fas fa-user-secret"></i>
                <span>Career Section</span>
            </a>
            <div id="collapseCareer" class="collapse {{ Request::is('admin/job/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.job.index') }}">Jobs</a>
                    <a class="collapse-item" href="{{ route('admin.job.view_application') }}">Job Applications</a>
                </div>
            </div>
        </li>
        @endif


        <!-- Photo Gallery -->
        @php if( in_array('Photo Gallery', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/photo-gallery/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.photo.index') }}">
                <i class="fas fa-camera"></i>
                <span>Photo Gallery</span>
            </a>
        </li>
        @endif

        <!-- Video Gallery -->
        @php if( in_array('Video Gallery', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/video-gallery/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.video.index') }}">
                <i class="fas fa-video"></i>
                <span>Video Gallery</span>
            </a>
        </li>
        @endif

        <!-- Product Section -->
        @php if( in_array('Product Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/product/*')||Request::is('admin/shipping/*')||Request::is('admin/coupon/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                <i class="fas fa-shopping-cart"></i>
                <span>Product Section</span>
            </a>
            <div id="collapseProduct" class="collapse {{ Request::is('admin/product/*')||Request::is('admin/shipping/*')||Request::is('admin/coupon/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.product.index') }}">Product</a>
                    <a class="collapse-item" href="{{ route('admin.shipping.index') }}">Shipping</a>
                    <a class="collapse-item" href="{{ route('admin.coupon.index') }}">coupon</a>
                </div>
            </div>
        </li>
        @endif

        <!-- Order -->
        @php if( in_array('Order Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/order/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.order.index') }}">
                <i class="fas fa-bookmark"></i>
                <span>Order Section</span>
            </a>
        </li>
        @endif

        <!-- Customer -->
        @php if( in_array('Customer Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/customer/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.customer.index') }}">
                <i class="fas fa-users"></i>
                <span>Customer Section</span>
            </a>
        </li>
        @endif

        <!-- Why Choose Us -->
        @php if( in_array('Why Choose Us', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/why-choose/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.why_choose.index') }}">
                <i class="fas fa-arrows-alt"></i>
                <span>Why Choose Us</span>
            </a>
        </li>
        @endif

        <!-- Services -->
        @php if( in_array('Service', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/service/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.service.index') }}">
                <i class="fas fa-certificate"></i>
                <span>Service</span>
            </a>
        </li>
        @endif

        <!-- Testimonials -->
        @php if( in_array('Testimonial', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/testimonial/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.testimonial.index') }}">
                <i class="fas fa-award"></i>
                <span>Testimonial</span>
            </a>
        </li>
        @endif

        <!-- Team Members -->
        @php if( in_array('Team Member', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/team-member/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.team_member.index') }}">
                <i class="fas fa-user-plus"></i>
                <span>Team Member</span>
            </a>
        </li>
        @endif

        <!-- FAQ -->
        @php if( in_array('FAQ', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/faq/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.faq.index') }}">
                <i class="fas fa-question-circle"></i>
                <span>FAQ</span>
            </a>
        </li>
        @endif

        <!-- Email Template -->
        @php if( in_array('Email Template', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/email-template/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.email_template.index') }}">
                <i class="fas fa-envelope"></i>
                <span>Email Template</span>
            </a>
        </li>
        @endif

        <!-- Subscriber -->
        @php if( in_array('Subscriber Section', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/subscriber/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubscriber" aria-expanded="true" aria-controls="collapseSubscriber">
                <i class="fas fa-share-alt-square"></i>
                <span>Subscriber Section</span>
            </a>
            <div id="collapseSubscriber" class="collapse {{ Request::is('admin/subscriber/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.subscriber.index') }}">All Subscribers</a>
                    <a class="collapse-item" href="{{ route('admin.subscriber.send_email') }}">Send Email to Subscribers</a>
                </div>
            </div>
        </li>
        @endif

        <!-- Social Media -->
        @php if( in_array('Social Media', $arr_one) || $logged_user_role_id==1 ): @endphp
        <li class="nav-item {{ Request::is('admin/social-media/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.social_media.index') }}">
                <i class="fas fa-basketball-ball"></i>
                <span>Social Media</span>
            </a>
        </li>
        @endif


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="btn btn-info btn-sm mt-3" href="{{ url('/') }}" target="_blank">
                            Visit Website
                        </a>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admin')->user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('uploads/'.Auth::guard('admin')->user()->photo) }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                            @if(Auth::guard('admin')->user()->id == 1)
                            <a class="dropdown-item" href="{{ route('admin.profile_change') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Change Profile
                            </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('admin.password_change') }}">
                                <i class="fas fa-unlock-alt fa-sm fa-fw mr-2 text-gray-400"></i> Change Password
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.photo_change') }}">
                                <i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i> Change Photo
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('admin_content')

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('admin.includes.scripts-footer')

</body>
</html>
