<?php

function university_register_search() {
    //args = namespace, route, array
    register_rest_route('university/v1', 'search', array(
        //WP_REST_SERVER = safer version of 'GET'
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'university_search_results',
    ));
}

add_action('rest_api_init', 'university_register_search');

function university_search_results($data) {
    $main_query = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term']),
    ));


  $results = array(
      'general_info' => array(),
      'professors' => array(),
      'programs' => array(),
      'events' => array(),
      'campuses' => array(),
  );

    while($main_query->have_posts()) {
        $main_query->the_post();
        if (get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['general_info'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' => get_post_type(),
                'author_name' => get_the_author(),
                'id' => get_the_id(),
            ));
        } if (get_post_type() == 'professor' ) {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                // 0 = current post
                'image' => get_the_post_thumbnail_url(0, 'professor_landscape'),
                'id' => get_the_id(),
            ));
        } if (get_post_type() == 'program' ) {
            $related_campuses = get_field('related_campus');
            if ($related_campuses) {
                foreach($related_campuses as $campus) {
                    array_push($results['campuses'], array(
                        'title' => get_the_title($campus ),
                        'permalink' => get_the_permalink($campus ),
                    ));
                };
            }
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'id' => get_the_id(),
            ));
        } if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $excerpt = null;
            if (has_excerpt()) {
                $excerpt = get_the_excerpt(); 
            } else { 
                $excerpt = wp_trim_words(get_the_content(), 18); 
            } 
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'excerpt' => $excerpt,
                'id' => get_the_id(),
            ));
        } 
        
        if (get_post_type() == 'campus') {
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'id' => get_the_id(),
            ));
        }
        
    }

    if ($results['programs']) {
        $programs_meta_query = array('relation' => 'OR');
    
    foreach($results['programs'] as $item) {
        array_push($programs_meta_query, array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => '"' . $item['id'] . '"',
        ));
    }

    $program_relationship_query = new WP_Query(array(
        'post_type' => array('professor', 'event') ,
        'meta_query' => $programs_meta_query, 
    ));

    while($program_relationship_query->have_posts()) {
        $program_relationship_query->the_post();

        if (get_post_type() == 'professor' ) {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                // 0 is current post in wordpress
                'image' => get_the_post_thumbnail_url(0, 'professor_landscape'),
                'id' => get_the_id(),
            ));
        }

        if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $excerpt = null;
            if (has_excerpt()) {
                $excerpt = get_the_excerpt(); 
            } else { 
                $excerpt = wp_trim_words(get_the_content(), 18); 
            } 
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'excerpt' => $excerpt,
                'id' => get_the_id(),
            ));
        } 

       

    }

    $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));

    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));

    $results['campuses'] = array_values(array_unique($results['campuses'], SORT_REGULAR));

    }
    
    return $results;
}
?>