<!-- for individual posts -->

<?php
get_header(); ?>



<?php
while (have_posts()) {
    the_post();
    page_banner(); ?>
    

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home</a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on
          <?php
            $date_format = 'n.j.y';
            the_time($date_format); 
          ?>
          in 
            <!-- <a href="<?php echo get_category_link($categories[0]->name); ?>"> -->
              <?php
                 echo get_the_category_list(', ');?>
              </a>  </span></p>
        </div>
    <!-- </div> -->
    <div class="generic-content">
        <?php the_content(); ?>
    </div>

    </div>


<?php
}

get_footer();
?>