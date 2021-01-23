<?php
get_header(); 
page_banner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description(),
));
?>


<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post(); ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on
          <?php
            $date_format = 'n.j.y';
            the_time($date_format); 
          ?>
          in 
            <!-- <a href="<?php echo get_category_link($categories[0]->name); ?>"> -->
              <?php
                 echo get_the_category_list(', ');                                                                             // $categories = get_the_category();
                                                                                        // if (!empty($categories)) {
                                                                                              //   echo esc_html($categories[0]->name);
                                                                                              // }
                                                                                              // ?>
              </a>                                                                                
        </p>
      </div>
      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
      </div>


  <?php }
  echo paginate_links();
  ?>
 </div>

<?php get_footer(); 

?>
