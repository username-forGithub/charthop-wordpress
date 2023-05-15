<?php
$hide = $args['hide'] ?? false;

?><section class="trusted_by">
    <div class="container">
        <h2><?php the_field('logos_trusted_title', 'options'); ?> </h2>
        <div class="row align-items-center">
            <?php
                if (have_rows('logos_trusted', 'options')):
                    while (have_rows('logos_trusted', 'options')) : the_row();
            ?>        
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <a class="proud_part_box">
                            <img src="<?php the_sub_field('image', 'options'); ?> " alt="">
                        </a>
                    </div>
            <?php endwhile; else : endif; ?>
        </div>

        <?php
        
         if($hide == true):
            $getlink = get_field('view_all', 'options');
            if( $getlink ): 
                $link_url = $getlink['url'];
                $link_title = $getlink['title'];                       
                ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";                                              
        ?>                     
                <a class="readmore" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>