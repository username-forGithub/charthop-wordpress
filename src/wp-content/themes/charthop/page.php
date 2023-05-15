<?php
get_header();


if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    ?>
    <div class="container ptop ptop--mini text_style">
        <div class="default_text">
            <h1><?php the_title(); ?></h1>

            <?php if ( has_post_thumbnail() ) { ?>
                <div class="thumbnail-class">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>
            
            <?php the_content(); ?>
        </div>
    </div>
       
    <?php 
  endwhile;
  wp_reset_postdata();
endif;


// related resources widget
get_template_part('template-parts/related', 'resources-widget');


 get_footer(); ?>