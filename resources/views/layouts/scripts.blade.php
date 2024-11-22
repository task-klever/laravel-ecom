@if($g_setting->google_analytic_status == 'Show')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $g_setting->google_analytic_tracking_id }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ $g_setting->google_analytic_tracking_id }}');
</script>
@endif

@if($g_setting->cookie_consent_status == 'Show')
    <script src="https://cdn.websitepolicies.io/lib/cookieconsent/1.0.3/cookieconsent.min.js" defer></script><script>window.addEventListener("load",function(){window.wpcc.init({"colors":{"popup":{"background":"#{{ $g_setting->cookie_consent_bg_color }}","text":"#{{ $g_setting->cookie_consent_text_color }}","border":"#b3d0e4"},"button":{"background":"#{{ $g_setting->cookie_consent_button_bg_color }}","text":"#{{ $g_setting->cookie_consent_button_text_color }}"}},"position":"bottom-left","padding":"large","margin":"none","content":{"message":"{{ $g_setting->cookie_consent_message }}","button":"{{ $g_setting->cookie_consent_button_text }}"}})});</script>
@endif

<!-- All JS -->
<script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('frontend/js/select2.full.js') }}"></script>
<script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
