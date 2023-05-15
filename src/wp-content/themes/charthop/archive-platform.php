
<?php get_header();?>


<div class="our_platform_dec">
    <div class="home_hero our_platform">
        <div class="container">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">
            <h1><?php the_field('title', 'options'); ?> </h1>
            <div class="our_platform_herotxt">
                <p><?php the_field('subtitle', 'options'); ?> </p>
            </div>
            <div class="hero_watch">
                <a data-fancybox href="<?php the_field('video_url', 'options'); ?> ">Watch video <span>(<?php the_field('video_duration', 'options'); ?> )</span></a>
            </div>
            <div class="home_hero_form">
                <div class="label"><?php the_field('top_banner_request_title', 'options'); ?> </div>              
                <?php

                get_template_part('template-parts/form', 'hero');
                //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');?>
            </div>
            </div>
            <div class="col-lg-6 relative order-1 order-lg-2">
            <div class="our_platform_img">
                <img src="<?php the_field('banner_image', 'options'); ?> " alt="">
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
                            
                            <a href="<?php the_permalink(); ?>" class="solubox">
                                <div class="solubox_height">
                                <div class="solubox_icon">
                                    <img src="<?php the_field('banner_icon'); ?> " alt="" data-no-retina>
                                </div>
                                <h3><?php the_title(); ?> </h3>
                                <p><?php the_excerpt(); ?> </p>
                                </div>
                                <span class="readmore">Learn more</span>
                            </a>
                        </div>
                    
            <?php    
                    } 
                } 
            ?>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/charthop', 'benefits'); ?>


<?php get_template_part('template-parts/logos', 'trusted', ["hide" =>false]);



if (! empty(get_field('choose_testimonials', 'options')))
{
    get_template_part(
        'template-parts/section',
        'testimonials',
        [
            'testimonials_id' => 'choose_testimonials',
            'link_id'   => 'top_link',
            'acf_id'    =>  'options'
        ]
    );
}
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