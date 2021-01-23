<?php

require get_theme_file_path('/inc/search-route.php');

function university_custom_rest() {
    register_rest_field('post','author_name',array(
        'get_callback' => function() {
            return get_the_author();
        }
    ));
    register_rest_field('note','user_note_count',array(
        'get_callback' => function() {
            return count_user_posts(get_current_user_id(), 'note');
        }
    ));
}

add_action('rest_api_init', 'university_custom_rest');

    function page_banner($args = NULL) {
        if (!$args['title']) {
            $args['title'] = get_the_title();
        }
        if (!$args['subtitle']) {
            $args['subtitle'] = get_field('page_banner_subtitle');
        }
        if (!$args['photo']) {
            if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
                $args['photo'] = get_field('page_banner_background_image')['sizes']['page_banner'];
            } else {
                $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }
           
        }

        ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php 
             echo $args['photo'];
        ?>
        );"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </div>
    </div>

<?php }


    function university_files() {
        
        
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        // wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
        wp_enqueue_script('google_map', '//maps.googleapis.com/maps/api/js?key=keyhere', NULL, '1.0', true);

        if ( strstr($_SERVER['SERVER_NAME'], '127.0.0.1')) {
            wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
        }
        else {
            wp_enqueue_script('our-vendors-js',  get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
            wp_enqueue_script('main-university-js',  get_theme_file_uri('/bundled-assets/scripts.bc49dbb23afb98cfc0f7.js'), NULL, '1.0', true);
            wp_enqueue_style('our-main-style', get_theme_file_uri('/bundled-assets/styles.bc49dbb23afb98cfc0f7.css'));
        }
       
        wp_localize_script('main-university-js', 'university_data', array(
            'root_url' => get_site_url(),
            //nonce for DELETE authorization in My Notes
            'nonce' => wp_create_nonce('wp_rest'),
        ));
    }
    add_action('wp_enqueue_scripts', 'university_files');

    function university_features() {
        add_theme_support( 'title-tag');
        add_theme_support('post-thumbnails');
        
        add_image_size('professor_landscape', 400, 260, true);
        add_image_size('professor_portrait', 480, 650, true);
        add_image_size('page_banner', 1500, 350, true);
        // register_nav_menu('header-menu-location', 'Header Menu Location');
        // register_nav_menu('footer_location_one', 'Footer Location One');
        // register_nav_menu('footer_location_two', 'Footer Location Two');
           
    }
    add_action('after_setup_theme', 'university_features');

        
    function university_adjust_queries($query) {
        if ( !is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
            $query->set('posts_per_page', -1);
        }

        if ( !is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);
        }
        
        if ( !is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
            $today = date('Ymd');
            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric',
                )
            ));
        }
        
    }
    add_action('pre_get_posts', 'university_adjust_queries');

    function university_map_key($api) {
        $api['key'] = 'AIzaSyAE3Z4nTdOD8DTpjOmc1UTNGRrKdQ_LHEU';
        return $api;
    
    }
    add_filter('acf/fields/google_map/api', 'university_map_key');

    // Redirect subscriber accounts out of admin and onto homepage

    add_action('admin_init', 'redirect_subs_to_frontend');

    function redirect_subs_to_frontend() {
        $our_current_user = wp_get_current_user();
        
        // if current user only has one role and that role is subscriber 

        if (count($our_current_user->roles) == 1 AND $our_current_user->roles[0] == 'subscriber') {
            wp_redirect(site_url('/'));
            exit;
        }
    }

    add_action('wp_loaded', 'no_subs_admin_bar');

    // Don't show admin bar to logged-in subscribers 

    function no_subs_admin_bar() {
        $our_current_user = wp_get_current_user();
        
        if (count($our_current_user->roles) == 1 AND $our_current_user->roles[0] == 'subscriber') {
            show_admin_bar(false);
        }
    }

    // Customize login screen

    add_filter('login_headerurl', 'our_header_url');

    function our_header_url() {
        return esc_url(site_url('/'));
    }

    // Load CSS for login screen

    add_action('login_enqueue_scripts','our_login_css');

    function our_login_css() {
        wp_enqueue_style('our-main-style', get_theme_file_uri('/bundled-assets/styles.bc49dbb23afb98cfc0f7.css'));
        wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    }

    // Custom title in login screen

    add_filter('login_headertitle', 'our_login_title');

    function our_login_title() {
        return get_bloginfo('name');
    }

    // Force note posts to be private

    add_filter('wp_insert_post_data', 'make_note_private', 10, 2);

    function make_note_private($data, $postarr) {
        if ($data['post_type'] == 'note') {
            if (count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
                die('You have reached your note limit.');
            }
            $data['post_content'] = sanitize_textarea_field($data['post_content']);
            $data['post_title'] = sanitize_text_field($data['post_title']);
        }
    //     if ($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
    //         $data['post_status'] = "private"; 

    //     }
    return $data;
}


?>