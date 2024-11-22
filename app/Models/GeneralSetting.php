<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'logo',
        'favicon',
        'login_bg',
        'top_bar_email',
        'top_bar_phone',
        'top_bar_social_status',
        'top_bar_login_status',
        'top_bar_registration_status',
        'top_bar_cart_status',
        'sidebar_total_recent_post',
        'theme_color',
        'footer_column1_heading',
        'footer_column2_heading',
        'footer_column3_heading',
        'footer_column4_heading',
        'footer_address',
        'footer_email',
        'footer_phone',
        'footer_copyright',
        'preloader_photo',
        'preloader_status',
        'sticky_header_status',
        'google_analytic_tracking_id',
        'google_analytic_status',
        'tawk_chat_code',
        'tawk_chat_status',
        'cookie_consent_status',
        'banner_about',
        'banner_service',
        'banner_service_detail',
        'banner_blog',
        'banner_blog_detail',
        'banner_category',
        'banner_project',
        'banner_project_detail',
        'banner_team_member',
        'banner_team_member_detail',
        'banner_photo_gallery',
        'banner_video_gallery',
        'banner_faq',
        'banner_product',
        'banner_product_detail',
        'banner_contact',
        'banner_search',
        'banner_cart',
        'banner_checkout',
        'banner_login',
        'banner_registration',
        'banner_forget_password',
        'banner_customer_panel',
        'banner_career',
        'banner_job',
        'banner_job_application',
        'banner_term',
        'banner_privacy'
    ];

}
