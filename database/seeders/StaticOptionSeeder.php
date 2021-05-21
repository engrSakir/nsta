<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaticOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        set_static_option('no_image', 'uploads/images/setting/no-image.png');
        set_static_option('fav_icon', null);
        set_static_option('frontend_logo', null);
        set_static_option('backend_logo', null);
        set_static_option('backend_light_logo', null);
        set_static_option('backend_text_logo', null);
        set_static_option('backend_text_light_logo', null);
        set_static_option('breadcrumb_image', null);

        set_static_option('company_email', 'company@gmail.com');
        set_static_option('company_phone', '01234567890');
        set_static_option('company_address', 'company---adddress');

        set_static_option('company_facebook_link', 'https://www.facebook.com/');
        set_static_option('company_twitter_link', 'https://twitter.com/');
        set_static_option('company_youtube_link', 'https://www.youtube.com/');
        set_static_option('company_instagram_link', 'https://www.instagram.com/');
        set_static_option('company_linkedin_link', 'https://www.linkedin.com/');

        set_static_option('sms_api_key', null);
        set_static_option('sms_api_pass', null);

        set_static_option('note_for_social_network', 'Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies');

        set_static_option('custom_head_code', null);
        set_static_option('custom_foot_code', null);

        set_static_option('footer_credit', 'All right reserved by <b>'. config('app.name').'</b>');

        set_static_option('meta_description', null);
        set_static_option('meta_keywords', null);
        set_static_option('meta_author', null);
        set_static_option('meta_image', null);

        set_static_option('fb_auto_extend', true);
        set_static_option('fb_page_connection', false);
        set_static_option('fb_page_id', '1234567890');
        set_static_option('fb_theme_color', '#7646ff');

        set_static_option('map_link', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.0133007741765!2d90.36988341538513!3d23.78254069346373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1bb07d0e771%3A0x127069c31b3f2ad7!2sDATATECH%20BD%20LTD.!5e0!3m2!1sbn!2sbd!4v1617710466238!5m2!1sbn!2sbd"');

        set_static_option('banner_highlight', 'নিউ শাপলা ট্রান্সপোর্ট এজেন্সি');
        set_static_option('banner_description', 'আন্তঃ জিলা স্থলপথে মাল পরিবহন ঢাকা মহানগর পণ্য পরিবহণ এজেন্সী মালিক সমিতির অন্তর্ভুক্ত রেজিঃ-ঢ=৩১৭১');
        set_static_option('banner_url', 'https://www.youtube.com/embed/plq25RrBPz8');
        set_static_option('banner_image', 'https://bootstrapmade.com/demo/templates/Arsha/assets/img/hero-img.png');

        set_static_option('about_title', 'আমাদের সম্পর্কে');
        set_static_option('about_description', 'নিউ শাপলা ট্রান্সপোর্ট এজেন্সি একটি বাংলাদেশের স্বনামধন্য ট্রান্সপোর্ট এজেন্সি কম্পানি .... ... ..... ..... ... ... ...');

        set_static_option('strength_image', 'https://bootstrapmade.com/demo/templates/Arsha/assets/img/skills.png');
        set_static_option('strength_title', 'Voluptatem dignissimos provident quasi corporis voluptates');
        set_static_option('strength_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

        set_static_option('service_title', 'আমাদের সার্ভিস সমূহ');
        set_static_option('service_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.');

        set_static_option('call_to_action_background_image', null);

        set_static_option('portfolio_title', 'আমাদের কাজ');
        set_static_option('portfolio_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.');

        set_static_option('team_title', 'আমাদের সদস্য সমূহ');
        set_static_option('team_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.');

        set_static_option('price_title', 'প্যাকেজ এবং মূল্য');
        set_static_option('price_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.');

        set_static_option('faq_title', 'সচরাচর জিজ্ঞাস্য');
        set_static_option('faq_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.');

        set_static_option('testimonial_title', 'মন্তব্যসমূহ');
        set_static_option('testimonial_description','Tamen quem nulla quae legam multos aute sint culpa legam noster magna');

        set_static_option('message_title', 'আমাদের মেসেজ পাঠান');
        set_static_option('message_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.');

        set_static_option('subscriber_title', 'আমাদের সাথে সংযুক্ত থাকুন');
        set_static_option('subscriber_description','Tamen quem nulla quae legam multos aute sint culpa legam noster magna');
    }
}
