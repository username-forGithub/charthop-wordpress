<?php get_header(); ?>



<section class="single_blog_content ptop ptop--mini">
    <div class="container long">

        <ul class="blog_tags row no-gutters">  
            <?php $terms = get_the_terms( get_the_ID(), 'integration' );
            
            foreach ( $terms as $term) { ; ?>            
                
                <li class="col-auto"><a href="<?php echo get_category_link( $term->term_id ); ?>"><?php echo $term->name; ?> </a></li>

            <?php } ?>
        </ul>
    
        <div class="row text_style">
            <div class="col-md-8 ">
                <div class="w813">
                    <h1><?php the_title(); ?></h1>
                    <div class="single_custom_image integ w830">
                        <?php the_post_thumbnail(); ?>
                    </div>

                    <div class="single_custom_text integ w830">
                        <h2><?php the_field('sub_image_content_title'); ?></h2>
                        <?php the_field('sub_image_content_text'); ?>

                        <h2><?php the_field('ticks_title'); ?> </h2>
                        
                        <div class="row distribute_row grid52">

                            <?php
                            if (have_rows('ticks_repeater')):
                                while (have_rows('ticks_repeater')):the_row();
                            ?>        
                            <div class="col-md-6">
                                <div class="distribute_block">
                                    <?php the_sub_field('text'); ?> 
                                </div>                      
                            </div>    

                            <?php endwhile; endif; ?>
                        </div> 

                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="single_blog_sidebar w300 integ form-class">

                    <?php

                    if (get_field('download_shortcode')) :
                        ?><div class="purple_box forform"><?php

                            get_template_part(
                                'template-parts/form',
                                'download-guide',
                                [
                                    'special_form' => get_field('download_shortcode'),
                                    'special_title' =>  get_field('download_title')
                                ]
                            );


                        ?></div><?php
                    endif;

                    ?><div class="pl30_ondesk">
                        <?php
                        if (have_rows('rs_related_links')) :

                        ?><div class="single_blog_sidebar_box">
                            <h3>Related links</h3><div class="row"><?php

                                while (have_rows('rs_related_links')) : the_row();
                                    $link = get_sub_field('link');
                                    ?><div class="col-6 col-md-12">
                                        <div class="related_sol">
                                            <h4><?php echo $link['title']; ?></h4>
                                            <a href="<?php echo $link['url']; ?>" class="readmore">Read more</a>
                                        </div>
                                    </div><?php
                                endwhile;

                            ?></div>
                        </div><?php

                        endif;
                        $get_in_touch_content = get_field('srs_get_in_touch', 'options');
                        $get_in_touch_link = get_field('srs_get_in_touch_button', 'options');

                        if (! empty($get_in_touch_content) || ! empty($get_in_touch_link)) :
                            ?><div class="single_blog_sidebar_box"><?php

                                echo $get_in_touch_content;

                                ?><a href="<?php echo $get_in_touch_link['url']; ?>" <?php
                                    if ($get_in_touch_link['target']) {
                                        echo 'target="_blank"';
                                    }
                                ?> class="button"><span><?php
                                    echo $get_in_touch_link['title'];
                                ?></span></a>
                            </div><?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

if (have_rows('six_items_repeater')): ?>
    <section class="our_values sirenbg">
        <div class="container long">
            <div class="row grid52">
                <div class="col-12 text-center">
                <h2><?php the_field('six_item_block_title'); ?> </h2>
                </div>

                <?php
                    while (have_rows('six_items_repeater')) : the_row();
                ?>
                <div class="col-6 col-lg-4">
                    <div class="value_box">
                        <div class="value_box_icon">
                        <img src="<?php the_sub_field('icon'); ?> " alt="" data-no-retina>
                        </div>
                        <h4><?php the_sub_field('title'); ?></h4>
                        <p><?php the_sub_field('text'); ?></p>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section> <?php
endif;
?>





<?php 
    get_template_part('template-parts/logos', 'trusted', ["hide" => true]);

    // related resources widget
    get_template_part('template-parts/related', 'resources-widget');

    get_template_part('template-parts/demo', 'form');

get_footer(); ?>