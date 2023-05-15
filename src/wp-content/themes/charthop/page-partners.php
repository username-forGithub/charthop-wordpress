<?php
/*
  * Template Name: Partners
  * */
get_header();


if (have_posts()) :


    while (have_posts()) : the_post();

        ?><div class="home_hero light partners">
            <div class="container">
                <div class="row">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h1><?php the_title(); ?></h1>
                    <div class="our_platform_herotxt">
                    <p><?php the_field('partners_subtitle', get_the_ID()); ?> </p>
                    </div>

                    <div class="home_hero_form">

                    <div class="label"><?php the_field('banner_sup_email_text', get_the_ID()); ?> </div>
                    <?php

                    get_template_part('template-parts/form', 'hero');
                    //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');?>


                    </div>
                </div>
                <div class="col-lg-6 relative order-1 order-lg-2">
                    <div class="our_platform_img ">
                    <img src="<?php the_field('banner_image', get_the_ID()); ?> " alt="" data-no-retina>
                    </div>
                </div>

                </div>
            </div>
        </div><?php

        if (! empty(get_field('blog_section'))) : ?>
            <div class="single_blog_content about partners">
                <div class="container long">

                    <div class="row text_style">
                        <div class="col-md-8">
                            <div class="single_blog_text">
                                <?php the_field('blog_section'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="single_blog_sidebar">

                                <div class="single_blog_sidebar_box">
                                    <h3><?php the_field('blog_section_sidebar_title'); ?> </h3>

                                    <div class="row"><?php
                                        if (have_rows('blog_section_sidebar_repeater')):
                                            while (have_rows('blog_section_sidebar_repeater')) : the_row();
                                                ?>
                                                <div class="col-6 col-md-12 mb-4">
                                                    <div class="related_sol">
                                                        <h4><?php the_sub_field('title'); ?> </h4><?php

                                                        if (get_sub_field('link'))
                                                        {
                                                            ?><a href="<?php the_sub_field('link'); ?> " class="readmore">Read more</a><?php
                                                        }

                                                    ?></div>
                                                </div>

                                            <?php endwhile;

                                        endif; ?></div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php
        endif;



if (! get_field('ps_db_section')) :
    get_template_part('template-parts/charthop', 'benefits');
endif;



if (! empty(get_field('ts_single_testimonial'))) : ?>

    <div class="purple_quote_dec partners">
        <div class="container long">
            <div class="purple_quote text_style"><?php
                get_template_part('template-parts/block', 'testimonial');
            ?></div>
        </div>
    </div>

<?php endif; ?>


<?php if (get_field('integration_title')) : ?>
    <section class="bring_all">
        <div class="container">
            <div class="bring_all_title">
                <h2><?php the_field('integration_title'); ?> </h2>
            </div>
            <div class="bring_all_txt">
                <p><?php the_field('integration_text'); ?> </p>
            </div>

            <div class="row bring_all_icons grid52 justify-content-center">

                <?php
                if (have_rows('integration_logos')):
                    while (have_rows('integration_logos')) : the_row();
                ?>
                    <div class="col-3 col-lg-auto">
                        <img src="<?php the_sub_field('logo'); ?> " alt="" data-no-retina>
                        <p class="partners_name"><?php
                            the_sub_field('name');
                        ?></p>
                    </div>

                <?php endwhile; endif; ?>

                <div class="col-12 text-center">
                    <?php
                    $getlink = get_field('integration_link');
                    if( $getlink ):
                    $link_url = $getlink['url'];
                    $link_title = $getlink['title'];
                    ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";
                    ?>
                    <a class="readmore" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php endif;



// related resources widget
get_template_part('template-parts/related', 'resources-widget');

?><section class="before_foot type2">
    <div class="container long">
        <div class="row"><?php

            if (! empty(get_field('contact_form_text'))) :
                ?><div class="col-12">
                    <div class="before_foot_txt new-txt"><?php
                        the_field('contact_form_text');
                    ?></div>
                </div><?php
            endif;

            ?><div class="col-12">
                
                <?php                    
                    get_template_part('template-parts/form', 'charthopconnect');
                ?>
                
            </div>
        </div>
    </div>
</section>
<div class="line1"></div>
<div class="line2"></div>
<div class="line3"></div>





<?php
    endwhile;
    wp_reset_postdata();
endif;
get_footer(); ?>