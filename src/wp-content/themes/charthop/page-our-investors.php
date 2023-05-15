<?php
/*
  * Template Name: Our Investors
  * */
get_header(); ?>

<div class="home_hero light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">                
                <h1><?php the_title(); ?> </h1><?php

                if (! empty(get_the_content())) :

                    ?><div class="our_platform_herotxt"><?php
                        the_content();
                    ?></div><?php

                endif;

                if (! empty(get_field('top_banner_video'))) : ?>
                    <div class="hero_watch">
                        <a data-fancybox href="<?php the_field('top_banner_video'); ?> ">Watch video <span>(<?php the_field('video_duration'); ?>)</span></a>
                    </div><?php
                endif;
                ?>
                <div class="home_hero_form">
                <div class="label"><?php the_field('top_banner_request_title'); ?> </div>               
                <?php

                get_template_part('template-parts/form', 'hero');
                //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');?>
                </div>
            </div>
            <div class="col-lg-6 relative order-1 order-lg-2">
                <div class="our_platform_img">
                    <img src="<?php the_field('top_banner_image'); ?> " alt="" data-no-retina>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="investors_hero_dec"></div>


<div class="container long investors_content">
    <div class="row grid52">

        <?php               
            $featured_posts = get_field('testimonials_section');              
        ?>
        <?php if ( $featured_posts ):  ?>
            <?php foreach( $featured_posts as $post ): 
                // Setup this post for WP functions (variable must be named $post).
                setup_postdata($post);

                    ?><div class="col-md-6 col-lg-4">
                        <div class="carousel_box"><?php

                            $icon = get_field('company_logo');

                            if (! empty($icon)) :
                                ?>
                                <div class="carousel_box_icon">
                                    <?php ?>
                                    <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" data-no-retina>
                                </div><?php
                            endif;

                            ?><div class="carousel_box_text">
                                <p><?php the_content(); ?> </p>
                            </div>
                            <div class="row carousel_box_author align-items-center">
                                <div class="col-auto">
                                    <?php
                                    $user_photo = IMG . '/user.png';

                                    if (has_post_thumbnail())
                                    {
                                        $user_photo = get_the_post_thumbnail_url(get_the_ID(), 'author');
                                    }

                                    if (! empty($user_photo)) :?>
                                        <img src="<?php echo $user_photo; ?>" alt="<?php the_title(); ?>" data-no-retina>
                                    <?php endif; ?>
                                </div>
                                <div class="col">

                                    <h4><?php the_title(); ?> </h4>
                                    <?php the_field('author_position'); ?>


                                </div>
                            </div>
                        </div>
                    </div><?php
            endforeach; ?>
        <?php endif; wp_reset_query();?>  
    </div>
</div>
<?php
if (have_rows('logo_section')):
    ?><section class="our_investors dec2">
        <div class="container ">
            <div class="row investor_row align-items-center grid52">
                <?php

                    while (have_rows('logo_section')) : the_row();
                ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="investor_logo">
                            <img src="<?php the_sub_field('logo'); ?> " alt="" data-no-retina>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section><?php
endif;

// related resources widget
get_template_part('template-parts/related', 'resources-widget');

get_template_part('template-parts/demo', 'form');
get_footer(); ?>