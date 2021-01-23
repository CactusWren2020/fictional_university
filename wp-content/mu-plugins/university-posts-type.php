<?php
      function university_post_types() {

        //campus post type

        register_post_type('campus', array(
            'show_in_rest' => true,
            'public' => true,
            'rewrite' => array('slug' => 'campuses'),
            'has_archive' => true,
            'menu_icon' => 'dashicons-location-alt',
            'labels' => array(
              'name' => 'Campuses',
                'add_new_item' => 'Add New Campus',
                'edit_item' => 'Edit Campus',
                'all_items' => 'All Campuses',
                'singular_name' => 'Campus',
            ),
            
            // 'capability_type' => 'campus',
            // 'map_meta_cap' => true,

            'supports' => array(
                'excerpt', 'title', 'editor', 
            )
        ));

        //event post type

        register_post_type('event', array(
            'show_in_rest' => true,
            'public' => true,
            'rewrite' => array('slug' => 'events'),
            'has_archive' => true,
            'menu_icon' => 'dashicons-calendar-alt',
            'labels' => array(
                'name' => 'Events',
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event',
            ),
            //'capability_type' => 'post' is the default setting
            'capability_type' => 'event',
            'map_meta_cap' => true,

            'supports' => array(
                'excerpt', 'title',
                //  'editor', 
            )
        ));
 

        //program post type
        
        register_post_type('program', array(
            'show_in_rest' => true,
            'public' => true,
            'rewrite' => array('slug' => 'programs'),
            'has_archive' => true,
            'menu_icon' => 'dashicons-awards',
            'labels' => array(
                'name' => 'Programs',
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Programs',
                'singular_name' => 'Program',
            ),
            'capability_type' => 'event',
            'map_meta_cap' => true,
            'supports' => array(
                 'title', 
                // 'editor', 
            )
        ));

        //disable gutenberg editor for post type, 'program' or 'event'
        
        add_filter('gutenberg_can_edit_post_type', 'prefix_disable_gutenberg', 10, 2);
        function prefix_disable_gutenberg($current_status, $post_type) {
            if ( in_array( $post_type, array( 'program', 'event' )))
            return false;
            return $current_status;
        }

        //add features

         
            // add_theme_supporT('post-thumbnails');
            // add_image_size('professor_landscape', 400, 260, true);
            // add_image_size('professor_portrait', 480, 650, true);
               
        
        //professor post type

        register_post_type('professor', array(
            'show_in_rest' => true,
            'public' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'labels' => array(
                'name' => 'Professors',
                'add_new_item' => 'Add New professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All professor',
                'singular_name' => 'professor',
            ),
            //custom role codes
            'capability_type' => 'professor',
            'map_meta_cap' => true,

            'supports' => array(
                 'title', 'editor', 'thumbnail',
            )
        ));

        //note post type

        register_post_type('note', array(
            'show_in_rest' => true,
            'public' => false,
            //to show a public=false post type in dashboard admin
            'show_ui' => true,
            'menu_icon' => 'dashicons-welcome-write-blog',
            'labels' => array(
                'name' => 'Notes',
                'add_new_item' => 'Add New Note',
                'edit_item' => 'Edit Note',
                'all_items' => 'All Note',
                'singular_name' => 'Note',
            ),
            //custom role codes
            'capability_type' => 'note',
            'map_meta_cap' => true,

            'supports' => array('title', 'editor')
        ));
    }
    add_action('init','university_post_types');
     
?>