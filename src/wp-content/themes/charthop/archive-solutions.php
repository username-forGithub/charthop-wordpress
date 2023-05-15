<?php get_header();?>


<div class="our_platform_dec solutions">
    <div class="home_hero our_platform">
        <div class="container">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">
            <h1><?php the_field('solutions_title', 'options'); ?> </h1>
            <div class="our_platform_herotxt">
                <p><?php the_field('solutions_subtitle', 'options'); ?> </p>
            </div>
            <div class="hero_watch">
                <a data-fancybox href="<?php the_field('solutions_video_url', 'options'); ?> ">Watch video <span>(<?php the_field('solutions_video_duration', 'options'); ?>)</span></a>
            </div>
            <div class="home_hero_form">
                <div class="label"><?php the_field('solutions_top_banner_request_title', 'options'); ?> </div>
                <?php

                get_template_part('template-parts/form', 'hero');
                //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');?>
            </div>
            </div>
            <div class="col-lg-6 relative order-1 order-lg-2">
            <div class="our_platform_img">
                <img src="<?php the_field('solutions_banner_image', 'options'); ?> " alt="">
            </div>
            </div>

        </div>
        </div>
    </div>
    <div class="container long">
        <div class="row our_platform_blocks grid52">

            <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                    the_post();
            ?>   
                        <div class="col-12 col-md-4">
                            <div class="solubox">
                                <div class="solubox_height">
                                <div class="solubox_icon">
                                    <img src="<?php the_field('banner_icon'); ?> " alt="" data-no-retina>
                                </div>
                                <h3><?php the_title(); ?> </h3>
                                <p><?php the_excerpt(); ?> </p>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="readmore">Learn more</a>
                            </div>
                        </div>
                    
            <?php    
                    } 
                } 
            ?>
        </div>
    </div>
</div>


<?php get_template_part('template-parts/logos', 'trusted');


if (! empty(get_field('choose_testimonials_solutions', 'options'))) :
    get_template_part(
        'template-parts/section',
        'testimonials',
        [
            'testimonials_id' => 'choose_testimonials_solutions',
            'link_id'   => 'top_link_solutions',
            'acf_id'    =>  'options'
        ]
    );
endif;

?>
<section class="latest_blog">
    <div class="container long">
        <div class="circle1"></div>
        <div class="circle2"></div>

        <?php 
            get_template_part('template-parts/our', 'thinking');
        ?>

    </div>      
</section>
<?php get_template_part('template-parts/demo', 'form'); ?>
<?php get_footer();?>