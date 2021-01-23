<form class="search-form" method="get" action="<?php echo esc_url(site_url('/'));?>">  
                        <label class="headline headline--medium" form="s">Perform a New Search</label>
                        <!-- action changes the location of the form submit -->
                        <div class="search-form-row">
                        <input placeholder="What are you looking for?" class="s" id="s" type="search" name="s"/>
                        <!--'s' plays along with native Wordpress search -->
                        <input class="search-submit" type="submit" value="Search"/>
                        </div>
                    </form>