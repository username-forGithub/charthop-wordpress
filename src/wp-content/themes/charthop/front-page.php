<?php get_header(); ?>


    <div class="home_hero_dec"></div>
    <div class="home_hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="home_hero_txt">
                        <h1><?php the_field('title'); ?> </h1>
                        <p><?php the_field('subtitle'); ?> </p>

                        <div class="home_hero_form">
                            <div class="label"><?php the_field('top_banner_request_title'); ?> </div>

                            <?php

                            //echo do_shortcode('[contact-form-7 id="63" title="Request a Demo"]');
                            get_template_part('template-parts/form', 'hero');

                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2"><?php
                    $banner_image_id = get_field('top_image');
                    ?>
                    <div class="hero_module"><?php

                        if ($banner_image_id)
                        {
                            echo wp_get_attachment_image($banner_image_id, 'home-banner');
                        }

                    ?>
                    </div>
                </div>
                <div class="col-12 text-center proud_partners order-3">
                    <div class="label"><?php the_field('logo_section_title'); ?> </div>
                    <div class="row">
                        <?php
                        if (have_rows('logo_item')):
                            while (have_rows('logo_item')) : the_row();
                                ?>
                                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                    <a class="proud_part_box">
                                        <img src="<?php echo get_sub_field('image'); ?>" data-no-retina>
                                    </a>
                                </div>
                            <?php endwhile; endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="why_chart">
        <div class="container long">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="label"><?php the_field('sup_text'); ?> </div>
                    <h2><?php the_field('why_title'); ?> </h2>
                </div>
                <div class="col-lg-6">
                    <div class="why_chart_txt">
                        <p><?php the_field('why_text'); ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our_solutions">
        <div class="container long">

            <div class="row">
                <div class="col-lg-6 xs-order-2">
                    <div class="solutions_image">
                        <img src="<?php the_field('solutions_image'); ?>" alt="image">
                    </div>
                </div>
                <div class="col-lg-6 xs-order-1">
                    <div class="label"><?php the_field('solutions_sup_text'); ?> </div>
                    <h2><?php the_field('solutions_title'); ?> </h2>
                </div>
            </div>
            <div class="row offsethere">

                <?php
                $solution_args = array(
                    'post_type' => 'solutions',
                    'post_status' => 'publish',
                    'posts_per_page' => 999,
                    'orderby' => 'Date',
                    // 'order' => 'ASC',                    
                );
                $solution_loop = new WP_Query($solution_args);
                ?>

                <?php while ($solution_loop->have_posts()) :$solution_loop->the_post(); ?>

                    <div class="col-12 col-md-4 col-lg-3 ">
                        <div class="solubox">
                            <div class="solubox_height">
                                <div class="solubox_icon">
                                    <img src="<?php the_field("banner_icon"); ?>" alt="" data-no-retina>
                                </div>
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="readmore">Learn more</a>
                        </div>
                    </div>

                <?php endwhile;
                wp_reset_postdata(); ?>

            </div>
        </div>
    </section>

    <div class="as_feat_dec"></div>
    <section class="as_feat">
        <div class="container">
            <h2>As featured in</h2>
            <div class="row">

                <?php
                if (have_rows('featured_logos')):
                    while (have_rows('featured_logos')) : the_row();
                        ?>
                        <div class="col-6 col-sm-4 col-lg-2 as_feat_logo">
                            <a><img src="<?php the_sub_field('image'); ?>" alt="" data-no-retina></a>
                        </div>

                    <?php endwhile; endif; ?>


            </div>
        </div>
    </section>


<?php
$platform_args = array(
    'post_type' => 'platform',
    'post_status' => 'publish',
    'posts_per_page' => 999,
    'orderby' => 'Date',
    // 'order' => 'ASC',

);
$platform_loop = new WP_Query($platform_args);
$count_num = $platform_loop->found_posts;
$sup_text = get_field('platforms_sup_text');
$plat_title = get_field('platforms_title');



if (isMobileDevice()) :

    ?><section class="platform_mobile show767 ">
        <div class="container">
            <div class="platform_mobile_title">
                <div class="label"><?php echo $sup_text; ?> </div>
                <h2><?php echo $plat_title; ?> </h2>
            </div>
            <div class="slider">

                <?php while ($platform_loop->have_posts()) : $platform_loop->the_post(); ?>

                    <div class="item">
                        <div class="platform_image_place"
                             style="background: url(<?php echo IMG; ?>/platform1.svg) no-repeat; background-size: cover;">
                            <div>
                                <img src="<?php the_field('top_banner_image'); ?>" alt="">
                            </div>
                        </div>
                        <div class="platform_box">
                            <div class="platform_icon">
                                <img src="<?php the_field('banner_icon'); ?>" alt="" data-no-retina>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="readmore">Learn more</a>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>

            <div class="slider_nav">
                <div class=" row justify-content-end align-items-center">
                    <div class="col-auto">
                        <div class="sliderbtn prev slider_btn_prev"></div>
                    </div>
                    <div class="col-auto">
                        <div class="pagingInfo slide-count-wrap">
                            <span class="current">1</span> of <span class="total"><?php echo $count_num; ?></span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="sliderbtn next slider_btn_next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
else:
    // disable on mobile
    ?><section class="platform hide767">
        
        <div class="container long">
            <div class="row ">
                
                <div class="col-md-6 col-lg-5">
                    <div class="label"><?php echo $sup_text; ?> </div>
                    <h2><?php echo $plat_title; ?> </h2>
                    <ul class="slides_menu">

                        <?php $count9 = 0; ?>

                        <?php while ($platform_loop->have_posts()) : $platform_loop->the_post(); ?>

                            <li data-li="<?php echo $count9; ?>"><a href="#"><?php the_title(); ?></a></li>

                        <?php $count9++;  endwhile; ?>

                    </ul>
                </div>
                <div class="col-md-6 col-lg-7 platform_holder ">
                    

                        <?php $count8 = 0;
                        while ($platform_loop->have_posts()) : $platform_loop->the_post(); ?>

                            <div class="platform_slide" data-slide="<?php echo $count8; ?>">
                                <div class="platform_slide_inside">
                                    <div class="platform_image_place"
                                            style="background: url(<?php echo IMG; ?>/platform1.svg) no-repeat; background-size: cover;">
                                        <div>
                                            <img src="<?php the_field('top_banner_image'); ?> " alt="">
                                        </div>
                                    </div>
                                    <div class="platform_box">
                                        <div class="platform_icon">
                                            <img src="<?php the_field('banner_icon'); ?> " alt="" data-no-retina>
                                        </div>
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="readmore">Learn more</a>
                                    </div>
                                </div>
                            </div>

                        <?php $count8++;  endwhile;
                        wp_reset_postdata(); ?>


                    
                </div>
            </div>            

        </div>
        
       
    </section><?php

endif;

get_template_part('template-parts/charthop', 'benefits');



if (! empty(get_field('choose_testimonials'))) :
    get_template_part(
        'template-parts/section',
        'testimonials',
        [
            'testimonials_id' => 'choose_testimonials',
            'link_id'   => 'top_link',
            'acf_id'    =>  ''
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


<?php


// related resources widget
get_template_part('template-parts/related', 'resources-widget');

get_template_part('template-parts/demo', 'form');

get_footer();