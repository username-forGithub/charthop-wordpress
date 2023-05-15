<?php get_header(); 

if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    ?>
    <div class="container ptop ptop--mini text_style">
        <div class="default_text">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>
    </div>
       
    <?php 
  endwhile;
  wp_reset_postdata();
endif;
        
        get_template_part('template-parts/demo', 'form');
        
        ?>
       <!-- <div style="background: url(homepage.png) no-repeat center top; height: 5000px;"></div> -->


<?php get_footer(); ?>