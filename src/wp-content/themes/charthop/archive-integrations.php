<?php get_header(); ?>

    <div class="home_hero_light_wrap">
        <div class="home_hero light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="h1_icon">
                            <img src="<?php the_field('integration_banner_icon', 'options'); ?> " alt="" data-no-retina>
                        </div>
                        <h1><?php echo post_type_archive_title('', false); ?> </h1>
                        <div class="our_platform_herotxt">
                            <p><?php the_field('integration_banner_subtitle', 'options'); ?> </p>
                        </div>
                        <div class="hero_watch">
                            <a data-fancybox href="<?php the_field('integration_banner_video', 'options'); ?> ">Watch
                                video <span>(<?php the_field('integration_video_duration', 'options'); ?>)</span></a>
                        </div>
                        <div class="home_hero_form">
                            <div class="label"><?php the_field('integration_banner_request_title', 'options'); ?> </div>
                            <?php
                            //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');
                            get_template_part('template-parts/form', 'hero');
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 relative order-1 order-lg-2">
                        <div class="our_platform_img">
                            <img src="<?php the_field('integration_banner_image', 'options'); ?> " alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="light_dec integ"></div>

    <section class="why_chart">
        <div class="container long">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mt--9"><?php the_field('integrations_subbanner_section_title', 'options'); ?> </h2>
                </div>
                <div class="col-lg-6">
                    <div class="why_chart_txt">
                        <p><?php the_field('integrations_subbanner_section_text', 'options'); ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our_values triple">
        <div class="container long">
            <div class="row grid52">
                <?php
                if (have_rows('integration_three_item_section', 'options')):
                    while (have_rows('integration_three_item_section', 'options')) : the_row();
                        ?>
                        <div class="col-6 col-lg-4">
                            <div class="value_box">
                                <div class="value_box_icon">
                                    <img src="<?php the_sub_field('icon'); ?> " alt="" data-no-retina>
                                </div>
                                <h4><?php the_sub_field('title'); ?> </h4>
                                <p> <?php the_sub_field('text2'); ?> </p>
                            </div>
                        </div>

                    <?php endwhile; endif; ?>
            </div>
        </div>
    </section>

    <div class="container long press_row integ">
        <div class="row grid52">
            <div class="col-12">
                <div class="press_row_h3">
                    <h3><?php the_field('integration_title', 'options'); ?> </h3>
                </div>
            </div>

            <?php
            $integration_query = new WP_Query(['post_type'=>'integrations', 'posts_per_page' => 24]);

            if ($integration_query->have_posts()) {
                while ($integration_query->have_posts()) {
                    $integration_query->the_post();
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="press_block">
                            <a href="<?php the_permalink(); ?>" class="press_block_image">
                                <img src="<?php the_post_thumbnail_url(); ?> " alt="" data-no-retina>
                            </a>
                            <h3>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <?php
                            the_excerpt();
                            // $excerpt = get_field("sub_image_content_text");
                            // $excerpt = substr( $excerpt, 0, 105 );
                            // echo $excerpt . "...";
                            ?>

                        </div>
                    </div>

                    <?php
                }
                $integration_query->reset_postdata();
            }
            ?>
        </div>
    </div>

    <div class="our_investors integs">
        <div class="container long">
            <div class="row investor_row align-items-center ">

                <?php
                $images = get_field('integration_logos', 'options');
                foreach ($images as $image):
                    ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="investor_logo">
                            <img src="<?php echo $image; ?> " alt="" data-no-retina>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php

if (get_field('asking_block', 'options')) :
?>
    <div class="asking_block">
        <div class="container">
            <div class="row align-items-center">
                <div class="order-2 order-lg-1 col-lg-6 col-xl-4">
                    <h3><?php the_field('asking_block', 'options'); ?> </h3>

                    <?php
                    $getlink = get_field('asking_link', 'options');
                    if ($getlink):
                        $link_url = $getlink['url'];
                        $link_title = $getlink['title'];
                        ($getlink['target']) ? $link_target = $getlink['target'] : $link_target = "";
                        ?>
                        <a class="readmore" href="<?php echo $link_url; ?> "
                           target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title; ?></a>
                    <?php endif; ?>

                </div>
                <div class="order-1 order-lg-2 col-lg-6 col-xl-8">
                    <div class="asking_block_image">
                        <img src="<?php the_field('asking_image', 'options'); ?> " alt="" data-no-retina>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
endif;

get_template_part('template-parts/related', 'resources-widget');

get_template_part('template-parts/demo', 'form');

get_footer(); ?>