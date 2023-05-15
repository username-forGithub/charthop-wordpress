<?php /*Template name: Solution Template */ ?>
<?php get_header();?>

    <div class="home_hero light">
        <div class="container">
            <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="h1_icon">
                <img src="<?php the_field('banner_icon'); ?> " alt="" data-no-retina>
                </div>
                <h1><?php the_title(); ?> </h1>
                <div class="our_platform_herotxt">
                <p><?php the_field('banner_subtitle'); ?> </p>
                </div>
                <div class="hero_watch">
                <a data-fancybox href="<?php the_field('top_banner_video'); ?> ">Watch video <span>(<?php the_field('video_duration'); ?>)</span></a>
                </div>
                <div class="home_hero_form">
                <div class="label"><?php the_field('top_banner_request_title'); ?> </div>               
                <?php
                get_template_part('template-parts/form', 'hero');
                //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');?>
                </div>
            </div>
            <div class="col-lg-6 relative order-1 order-lg-2">
                <div class="our_platform_img">
                <img src="<?php the_field('top_banner_image'); ?> " alt="">
                </div>
            </div>

            </div>
        </div>
    </div>

    <section class="why_chart">
        <div class="container long">
          <div class="row align-items-center">
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
    </section>

    <div class="container long distribute_row">
        <div class="row">
                    
            <?php
                if (have_rows('six_tick_section')):
                    while (have_rows('six_tick_section')) : the_row();
            ?> 
                <div class="col-md-6 col-lg-4">
                    <div class="distribute_block"><?php echo get_sub_field('text'); ?></div>
                </div> 
            <?php endwhile; else : endif; ?>
        </div>
    </div>


    <?php $count = 1;
        if (have_rows('image_and_text_section')):
            while (have_rows('image_and_text_section')) : the_row();
    ?>        
              
            <section class="reverses reverses-<?php echo $count; ?>">
                <div class="container long">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-xl order-2 order-lg-1">
                    <div class="reverses_txt">
                        <h2><?php echo get_sub_field('title'); ?></h2>
                        <p><?php echo get_sub_field('text'); ?></p>
                    </div>
                    </div>
                    <div class="col-lg-7 col-xl-auto order-1 order-lg-2">
                    <img src="<?php echo get_sub_field('image'); ?>" alt="" data-no-retina>
                    </div>
                </div>
                </div>
            </section>

    <?php $count++ ; endwhile; else : endif;




    if (have_rows('related_products_2')) :
        ?><section class="related_solutions">
            <div class="container long">
              <div class="related_solutions_title">
                <div class="label"><?php the_field('related_products_sup_text'); ?> </div>
                <h2><?php the_field('related_products_title'); ?> </h2>
              </div>
              <div class="row our_platform_blocks grid52">




                <?php
                  $featured_posts = get_field('related_products');
                ?>
                <?php
                while (have_rows('related_products_2')) : the_row();

                    ?><div class="col-12 col-md-4">
                        <div class="solubox">
                            <div class="solubox_height"><?php
                                $icon_url = get_sub_field('icon');
                                if (! empty($icon_url)) :
                                    ?><div class="solubox_icon">
                                        <img src="<?php echo $icon_url; ?>" alt="" data-no-retina>
                                    </div><?php
                                endif;

                                $title = get_sub_field('title');
                                if ($title) {
                                    echo '<h3';
                                    if (empty($icon_url))
                                    {
                                        echo ' class="no_mt"';
                                    }
                                    echo '>'.$title.'</h3>';
                                }

                                $content = get_sub_field('content');
                                if (! empty($content))
                                {
                                    echo '<p>'.$content.'</p>';
                                }

                            ?></div><?php

                            $cta_link = get_sub_field('cta_btn');

                            if (! empty($cta_link))
                            {
                                if ($cta_link['target'])
                                {
                                    echo '<a href="'.$cta_link['url'].'" class="readmore" target="_blank">'.$cta_link['title'].'</a>';
                                }
                                else
                                {
                                    echo '<a href="'.$cta_link['url'].'" class="readmore">'.$cta_link['title'].'</a>';
                                }
                            }


                        ?></div>
                    </div><?php

                endwhile;
            ?></div>
        </section><?php

    endif;




if (! empty(get_field('ts_single_testimonial'))) :


    ?><div class="purple_quote_dec">
        <div class="container long ">
            <div class="purple_quote text_style"><?php
                get_template_part('template-parts/block', 'testimonial');
            ?></div>
        </div>
    </div><?php
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

get_footer();?>