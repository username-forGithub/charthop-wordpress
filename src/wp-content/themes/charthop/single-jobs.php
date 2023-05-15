<?php get_header(); 

if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    ?>
    <div class="container ptop text_style ">
        <div class="default_text singlejob">
            <h1><?php the_title(); ?></h1>

            <?php 
            $getlink = get_field('back_to_all_jobs', 'options');
            if( $getlink ): 
                $link_url = $getlink['url'];
                $link_title = $getlink['title'];                       
                ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";                                              
            ?>                     
            <a class="readmore back" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
            <?php endif; ?>
            <?php the_content(); ?>

            <a href="#" class="button"><span>Apply now</span></a>
        </div>
    </div>

    <?php 
        $app_form = get_field('application_form'); 
        if(!empty($app_form)){
    ?> 
        <div class="singlejob_embed_form text-center">
            <?php the_field('application_form'); ?> 
        </div>
    
    <?php } else {?>
        <div class="singlejob_embed_form text-center">
           <img src="<?php echo IMG; ?>/embed_form.png" alt="">
            <!-- <iframe id="grnhse_iframe" width="100%" frameborder="0" scrolling="no" allow="geolocation" onload="window.scrollTo(0,0)" title="Greenhouse Job Board" src="https://boards.greenhouse.io/embed/job_app?for=charthop&token=4839932003&b=https%3A%2F%2Fwww.charthop.com%2Fcompany%2Fjob-openings%2F"></iframe> -->
        </div>
    <?php } ?>
       
    <?php 
  endwhile;
  wp_reset_postdata();
endif;



// related resources widget
get_template_part('template-parts/related', 'resources-widget');

 get_footer(); ?>