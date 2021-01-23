
    <footer class="site-footer">
      <div class="site-footer__inner container container--narrow">
        <div class="group">
          <div class="site-footer__col-one">
            <h1 class="school-logo-text school-logo-text--alt-color">
              <a href="<?php echo site_url();?>"><strong>Fictional</strong> University</a>
            </h1>
            <p><a class="site-footer__link" href="#">555.555.5555</a></p>
          </div>

          <div class="site-footer__col-two-three-group">
            <div class="site-footer__col-two">
              <h3 class="headline headline--small">
                Explore
                <?php
                  // $locations = get_nav_menu_locations();
                  // $menu = wp_get_nav_menu_object($locations['footer_location_one']);
                  // echo $menu->name; 
                ?>
              </h3>
              <nav class="nav-list">
                <ul>
                  <li><a href="
                  <?php echo site_url('/about-us');?>
                  ">About Us</a></li>
                  <li><a href="#">Programs</a></li>
                  <li><a href="#">Events</a></li>
                  <li><a href="#">Campuses</a></li>
                </ul>
              </nav>
              <!-- <nav class="nav-list"> -->
              <?php
                // $args_explore = [
                //         'theme_location' => 'footer_location_one',
                //         // 'menu_class' => 'nav-list',
                //         // 'container_class' => 'site-header__menu',
                // ];
                // wp_nav_menu($args_explore);
              ?>
              <!-- </nav> -->
            </div>

            <div class="site-footer__col-three">
              <h3 class="headline headline--small">
                Learn
              <?php
                // $menu2 = wp_get_nav_menu_object($locations['footer_location_two']);
                // echo $menu2->name;
              ?>
              </h3>
              <nav class="nav-list">
                <ul>
                  <li><a href="#">Legal</a></li>
                  <li><a href="<?php echo site_url('/privacy-policy');?>">Privacy</a></li>
                  <li><a href="#">Careers</a></li>
                </ul>
                <?php
                  // $args_learn = [
                  //     'theme_location' => 'footer_location_two',
                  // ];
                  // wp_nav_menu($args_learn);
                ?>
              </nav>
            </div>
          </div>

          <div class="site-footer__col-four">
            <h3 class="headline headline--small">Connect With Us</h3>
            <nav>
              <ul class="min-list social-icons-list group">
                <li>
                  <a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </footer>

  

<?php wp_footer(); ?>
</body>
</html>