<?php
/*
  * Template Name: Careers
  * */
get_header();  ?>

<div class="home_hero light careers">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 order-2 order-lg-1">
            <h1><?php the_title(); ?></h1>
            <div class="our_platform_herotxt">
            <p><?php the_field('careers_subtitle'); ?> </p>
            </div>

            <?php 
                $getlink = get_field('banner_link');
                if( $getlink ): 
                $link_url = $getlink['url'];
                $link_title = $getlink['title'];                       
                ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";                                              
            ?>                     
                <a class="button" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo $link_title ; ?></span></a>
                
            <?php endif; ?>
            
        </div>
        <div class="col-lg-6 relative order-1 order-lg-2">
            <div class="our_platform_img ">
                <img src="<?php the_field('banner_image'); ?> " alt="" data-no-retina>
            </div>
        </div>

        </div>
    </div>
</div>

<section class="why_chart">
    <div class="container long">
        <div class="row align-items-top">
            <div class="col-lg-6">
                <h2><?php the_field('sub_banner_section_title'); ?> </h2>
            </div>
            <div class="col-lg-6">
                <div class="why_chart_txt">
                    <p><?php the_field('sub_banner_section_text'); ?> </p>
                </div>
            </div>
        </div>
    </div>
</section><?php


if (! empty(get_field('choose_testimonials')))
{
    get_template_part(
        'template-parts/section',
        'testimonials',
        [
            'testimonials_id' => 'choose_testimonials',
            'link_id'   => 'top_link',
            'acf_id'    =>  '',
            'class'     =>  'careers'
        ]
    );
}

?>




  <?php
  $featured_posts = get_field('video_section');
  if ( $featured_posts ): ?>
    <div class="light_video_place">
        <div class="container long">
            <div class="row latest_blog_row grid52">
                  <?php foreach( $featured_posts as $post ):
                      // Setup this post for WP functions (variable must be named $post).
                      setup_postdata($post); ?>


                      <?php $img = get_the_post_thumbnail_url(); ?>
                    <div class="col-lg-4">
                        <div class="blog_box">
                            <div class="blog_box_image video">
                            <a href="<?php the_permalink(); ?>">
                                <span class="play">
                                    <svg class="playicon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15.167" height="21" viewBox="0 0 15.167 21">
                                    <defs>
                                        <clipPath id="clip-path">
                                        <path id="Path_45" data-name="Path 45" d="M23.333-38.5a1.167,1.167,0,0,1,.693.228l.032.025L36.8-28.984l0,0,.018.014a1.167,1.167,0,0,1,.517.968,1.167,1.167,0,0,1-.524.973l-12.783,9.3a1.167,1.167,0,0,1-.693.228,1.167,1.167,0,0,1-1.167-1.167V-37.333A1.167,1.167,0,0,1,23.333-38.5Z" fill="#6e37ff" clip-rule="evenodd"/>
                                        </clipPath>
                                        <clipPath id="clip-path-2">
                                        <path id="Path_44" data-name="Path 44" d="M-757,1258H683V-5320H-757Z"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_144" data-name="Group 144" transform="translate(-22.167 38.5)" clip-path="url(#clip-path)">
                                        <g id="Group_143" data-name="Group 143" clip-path="url(#clip-path-2)">
                                        <path id="Path_43" data-name="Path 43" d="M17.167-12.5H42.333v-31H17.167Z"/>
                                        </g>
                                    </g>
                                    </svg>
                                </span>
                                <img src="<?php echo $img; ?>" alt="" data-no-retina>
                            </a>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                    </div>
                  <?php endforeach; ?>

            </div>
        </div>
    </div>
  <?php endif; wp_reset_query();?>


    <section class="our_values careers">
    <?php get_template_part('template-parts/our', 'values'); ?>
</section>
<?php
if (get_field('how_we_got_here_section_title')) :
    ?>
    <section class="how_wegot careers">
        <div class="container">
            <div class="row grid52">
            <div class="col-auto">
                <div class="how_wegot_img">
                <img src="<?php the_field('how_we_got_here_section_image'); ?> " alt="" data-no-retina>
                </div>
                <div class="hero_watch">
                <a data-fancybox href="<?php the_field('video_url'); ?> ">Watch video <span>(<?php the_field('video_duration'); ?>)</span></a>
                </div>
            </div>
            <div class="col">
                <h2><?php the_field('how_we_got_here_section_title'); ?> </h2>
                <div class="job"><?php the_field('how_we_got_here_section_subitle'); ?> </div>
                    <?php the_field('how_we_got_here_section_content'); ?>
                <div class="signature_place">
                <img src="<?php the_field('how_we_got_here_section_signature'); ?> " alt="" data-no-retina>
                </div>
            </div>
            </div>
        </div>
    </section>
    <div class="how_wegot_dec"></div><?php
endif;

if (false) :
    $featured_testimonial = get_field('single_testimonial');
    if ( ! empty($featured_testimonial) ) :
        $cur_testimonial = $featured_testimonial[0];
        ?><div class="container long  careers_blockquote">
            <div class="row">
                <div class="col-lg-8 text_style order-2 order-lg-1">
                    <blockquote>
                        <?php echo strip_tags($cur_testimonial->post_content); ?>

                        <div class="row box_author align-items-center">
                        <div class="col">
                            <h4><?php echo$cur_testimonial->post_title; ?> </h4>
                            <?php the_field('author_position', $cur_testimonial->ID); ?>
                        </div>
                        </div>
                    </blockquote><?php

                    $getlink = '';
                    if (get_field('single_testimonial_link'))
                    {
                        // use careers' page link field
                        $getlink = get_field('single_testimonial_link');
                    }
                    else
                    {
                        // use testimonial link field
                        $getlink = get_field('link', $cur_testimonial->ID);
                    }
                    if( $getlink ) :
                        $link_url = $getlink['url'];
                        $link_title = $getlink['title'];
                        ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";

                        ?>
                        <a class="readmore" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
                    <?php
                    endif;
                ?></div>
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="careers_blockquote_image"><?php

                        $photo = IMG . '/user.png';
                        if (has_post_thumbnail($cur_testimonial->ID)) {
                            $photo = get_the_post_thumbnail_url($cur_testimonial->ID);
                        }

                        ?><img src="<?php echo $photo; ?> " alt="<?php echo $cur_testimonial->post_title; ?>" data-no-retina>
                    </div>
                </div>
            </div>
        </div><?php
    endif;
endif;

if (get_field('careers_quote_text') ):
    ?><div class="container long  careers_blockquote">
        <div class="row">
            <div class="col-lg-8 text_style order-2 order-lg-1">
                <blockquote>
                    <?php the_field('careers_quote_text'); ?>

                    <div class="row box_author align-items-center">
                    <div class="col">
                        <h4><?php the_field('careers_quote_fullname'); ?> </h4>
                        <?php the_field('careers_quote_subfullname'); ?>
                    </div>
                    </div>
                </blockquote>
                <?php
                    $getlink = get_field('careers_quote_link');
                    if( $getlink ):
                    $link_url = $getlink['url'];
                    $link_title = $getlink['title'];
                    ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";
                    ?>
                    <a class="readmore" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
                    <?php endif; ?>

            </div>
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="careers_blockquote_image">
                    <img src="<?php the_field('careers_quote_image'); ?> " alt="" data-no-retina>
                </div>
            </div>
        </div>
    </div>
<?php
endif;


if (have_rows('tick_section')):
    ?>
    <div class="container long distribute_row nodecs">
        <div class="row"><?php

            if (! empty(get_field('tick_section_title')))
            {
                ?><div class="col-12">
                    <div class="text_style text-center mb-5">
                        <h2><?php the_field('tick_section_title'); ?></h2>
                    </div>
                </div><?php
            }

                while (have_rows('tick_section')) : the_row();
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="distribute_block"><?php the_sub_field('text'); ?> </div>
                </div>

                <?php
                endwhile; ?>
        </div>
    </div><?php
endif;


    // related resources widget
    get_template_part('template-parts/related', 'resources-widget');


    $cta_sec_title = get_field('join_us_widget_title');
    $cta_sec_link = get_field('join_us_widget_cta');

    if (! empty($cta_sec_title) || ! empty($cta_sec_link)) :
        ?><section class="before_foot type3">
            <div class="container long">
                <div class="row">
                    <div class="col-12"><?php

                        if (! empty($cta_sec_title))
                        {
                            ?>
                            <div class="before_foot_txt">
                                <h3><?php echo $cta_sec_title; ?></h3>
                            </div><?php
                        }

                        if (! empty($cta_sec_link)) {
                            if ($cta_sec_link['target'] == '_blank')
                            {
                                ?>
                                <div class="text-center col-12">
                                    <a href="<?php echo $cta_sec_link['url']; ?>" target="_blank" class="button"><span><?php echo $cta_sec_link['title']; ?></span></a>
                                </div><?php
                            }
                            else
                            {
                                ?>
                                <div class="text-center col-12">
                                    <a href="<?php echo $cta_sec_link['url']; ?>" class="button"><span><?php echo $cta_sec_link['title']; ?></span></a>
                                </div><?php
                            }
                        }

                    ?></div>
                </div>
            </div>
        </section>
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div><?php
    endif;

//    get_template_part('template-parts/demo', 'form', ['class'=>'type3']);
get_footer(); ?>