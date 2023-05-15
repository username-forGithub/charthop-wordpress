        <footer>
           <div class="container long">
             <div class="row"><?php 
                $logo = get_field('footer_logotype', 'options');

                if (! empty($logo)) :
                    ?><div class="col-sm-6">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" data-no-retina>
                        </a>
                    </div><?php 
                endif;
                

                if (have_rows('footer_socials', 'options')) :

                    ?><div class="col-sm-6">
                        <ul class="social"><?php 
                        
                            while (have_rows('footer_socials', 'options')) : the_row(); 
                                $link = get_sub_field('link');
                                
                                if ($link['target']) :
                                    ?><li>
                                        <a href="<?php echo $link['url']; ?>" target="_blank">
                                            <i class="fa <?php the_sub_field('icon'); ?>" aria-hidden="true"></i>
                                        </a>
                                    </li><?php
                                else :
                                    ?><li>
                                        <a href="<?php echo $link['url']; ?>">
                                            <i class="fa <?php the_sub_field('icon'); ?>" aria-hidden="true"></i>
                                        </a>
                                    </li><?php
                                endif;

                            endwhile;
                            wp_reset_postdata()
                        
                        ?></ul>
                    </div><?php 
                    
                endif;
                ?>
              <div class="col-12">
                <hr>
              </div>
            </div>
            <div class="row foot_menu_place">
               <div class="col-6 col-md-3"><?php 

                if (! empty(wp_get_nav_menu_name('footer_1'))) {
                    echo '<h4>' . wp_get_nav_menu_name('footer_1') . '</h4>';
                }
               
                wp_nav_menu([
                   'theme_location' =>  'footer_1',
                   'container'      =>  false
                ])
               
               ?></div>               
               <div class="col-6 col-md-3"><?php 

                    if (! empty(wp_get_nav_menu_name('footer_2'))) {
                        echo '<h4>' . wp_get_nav_menu_name('footer_2') . '</h4>';
                    }

                    wp_nav_menu([
                        'theme_location' =>  'footer_2',
                        'container'      =>  false
                    ])

                ?></div>             
                <div class="col-6 col-md-3"><?php 
 
                     if (! empty(wp_get_nav_menu_name('footer_3'))) {
                        echo '<h4>' . wp_get_nav_menu_name('footer_3') . '</h4>';
                     }
 
                     wp_nav_menu([
                        'theme_location' =>  'footer_3',
                        'container'      =>  false
                     ])
 
                 ?></div>        
                 <div class="col-6 col-md-3"><?php 
  
                      if (! empty(wp_get_nav_menu_name('footer_4'))) {
                        echo '<h4>' . wp_get_nav_menu_name('footer_4') . '</h4>';
                      }
  
                      wp_nav_menu([
                        'theme_location' =>  'footer_4',
                        'container'      =>  false
                      ])
  
                  ?></div> 
            </div>
            <div class="row bottom">
              <div class="col-md-6 col-lg-auto"><?php 
              
                $partners_logos = get_field('footer_partners', 'options');
                $partners_text = get_field('footer_partners_text', 'options');

                if (! empty($partners_logos)) :
                
                    ?><div class="bottom_logo"><?php 
                    
                        foreach ($partners_logos as $image)
                        {
                            echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" data-no-retina>';
                        }
                    
                    ?></div><?php 
                
                endif;

                if (! empty($partners_text))
                {
                    echo $partners_text;
                }

            ?></div><?php 

            $privacy = get_field('privacy', 'options');
            $security = get_field('security', 'options');
            
            if (! empty(get_field('footer_copyright', 'options')))
            {
                echo '<div class="col-md-6 col-lg-auto">' . get_field('footer_copyright', 'options');

                if (! empty($privacy)) :
                    $privacy_title = $privacy['title'];
                    $privacy_url = $privacy['url'];
                    echo ' <a href="' . $privacy_url . '">' . $privacy_title . '</a> ';
                endif;
                    echo '|';

                if (! empty($security)) :
                    $security_title = $security['title'];
                    $security_url = $security['url'];
                    echo ' <a href="' . $security_url . '">' . $security_title . '</a>';
                endif;

                echo '</div>';
            }
            
            ?>
              
            </div>
           </div>
         </footer>
         
    </div><!--//.page_wrap-->
  <?php wp_footer(); ?>
</body>
</html>