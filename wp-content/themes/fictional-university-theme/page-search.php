<!-- search page template -->

<?php
get_header();

while (have_posts()) {
    the_post(); 
    page_banner();
    ?>
    

    <div class="container container--narrow page-section">

        <?php
        // get_the_ID() gets id of current page
        // wp_get_post_parent_id($id) gets id of post_parent, but false if there is no parent
            $the_parent = wp_get_post_parent_id(get_the_ID());

            if ( $the_parent ) { ?>

                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p><a class="metabox__blog-home-link" href="<?php
                    // get_permalink to get link to post parent
                    echo the_permalink($the_parent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php
                    // get title of parent for the link
                    echo get_the_title($the_parent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
                </div>
            <?php }
        ?>


        <?php 
        $test_array = get_pages(
            array( 'child_of' => get_the_ID())
        );
        //if it doesn't have children, returns null

        //if it either has a parent or is a child page
        if ($the_parent or $test_array) { ?> 
        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($the_parent); ?>"><?php echo get_the_title($the_parent); ?></a></h2>
            <ul class="min-list">
                <?php
                //this if statement controls which pages wp_list_pages will display. 
                if ($the_parent) {
                    $find_children_of = $the_parent;
                } else {
                    //if there is no parent page
                    $find_children_of = get_the_ID();
                }
                    $args = [
                        'child_of' => $find_children_of,
                        'title_li' => null,
                        'sort_column' => 'menu_order'
                    ];
                    wp_list_pages($args);
                ?>
            </ul>
        </div>
               <?php } ?>

        <div class="generic-content">
                    <?php 
                    get_search_form();
                    ?>
        </div>

    </div>


<?php
}

get_footer();
?>