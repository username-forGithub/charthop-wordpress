<?php
/*
  * Template Name: About us
  * */
get_header(); ?>



    <div class="home_hero_dec about"></div>
    <div class="home_hero about">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">
              <h1><?php the_title(); ?></h1>
              <div class="our_platform_herotxt">
                <p><?php the_field("banner_subtitle"); ?></p>
              </div>

              <div class="home_hero_form">
              <div class="label"><?php the_field('banner_sup_email_text'); ?> </div>              
                <?php

                get_template_part('template-parts/form', 'hero');
                //echo do_shortcode( '[contact-form-7 id="63" title="Request a Demo"]');?>
              </div>
            </div><?php
              $banner_image = get_field('banner_image');
              if (! empty($banner_image)) :
                ?>
                <div class="col-lg-6 relative order-1 order-lg-2">
                  <div class="our_platform_img">
                    <img src="<?php the_field('banner_image'); ?> " alt="" data-no-retina>
                  </div>
                </div><?php

              endif;?>

          </div>
        </div>
    </div>
  <?php
    $is_content_enable = get_field('blog_section');
    $has_second_block = false;
    if (have_rows('blog_section_sidebar_repeater'))
    {
        $has_second_block = true;
    }

    if ($is_content_enable || $has_second_block) :
        ?><div class="single_blog_content about">
            <div class="container long">

                <div class="row text_style"><?php

                    if ($is_content_enable) :
                        ?>
                        <div class="<?php echo $has_second_block ? 'col-md-8': 'col-md-12' ?>">
                            <div class="single_blog_text">
                                <?php the_field('blog_section'); ?>
                            </div>
                        </div><?php
                    endif;


                    if ($has_second_block): ?>
                        <div class="col-md-4 ">
                            <div class="single_blog_sidebar">

                                <div class="single_blog_sidebar_box">
                                    <h3><?php the_field('blog_section_sidebar_title'); ?> </h3>

                                    <?php

                                        while (have_rows('blog_section_sidebar_repeater')) : the_row();
                                    ?>

                                    <div class="related_sol">
                                        <h4><?php the_sub_field('title'); ?> </h4>
                                        <a href="<?php the_sub_field('link'); ?> " class="readmore">Read more</a>
                                    </div>

                                    <?php endwhile; ?>

                                </div>
                            </div>
                        </div><?php
                    endif;
                ?></div>
            </div>
        </div><?php
    endif;


    if (get_field('how_we_got_here_section_image') || get_field('how_we_got_here_section_title') || get_field('how_we_got_here_section_subitle')) :

        ?><section class="how_wegot about">
            <div class="container">
              <div class="row grid52"><?php

                if (get_field('how_we_got_here_section_image') || get_field('video_url')) :
                    ?><div class="col-auto">
                      <div class="how_wegot_img">
                        <img src="<?php the_field('how_we_got_here_section_image'); ?> " alt="" data-no-retina>
                      </div><?php
                        if (get_field('video_url')) :
                          ?><div class="hero_watch">
                            <a data-fancybox href="<?php the_field('video_url'); ?> ">Watch video <span>(<?php the_field('video_duration'); ?>)</span></a>
                          </div><?php
                        endif; ?>
                    </div><?php
                endif;?>
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
        <div class="how_wegot_circle"></div><?php

    endif;?>

    <section class="our_values">
        <?php get_template_part('template-parts/our', 'values'); ?>
    </section>
    <?php
    if (get_field('investors_title') || get_field('investors_subtitle')) :
        ?><section class="our_investors">
            <div class="container">
              <h2><?php the_field('investors_title'); ?> </h2>
              <div class="incestor_txt">
                <p><?php the_field('investors_subtitle'); ?> </p>
              </div>
              <div class="row investor_row align-items-center grid52">

                <?php
                if (have_rows('investors_logos')):
                    while (have_rows('investors_logos')) : the_row();
                ?>

                <div class="col-6 col-md-4 col-lg-2">
                  <div class="investor_logo">
                    <img src="<?php the_sub_field('logo'); ?> " alt="" data-no-retina>
                  </div>
                </div>
                <?php endwhile; endif; ?>


                <div class="col-12 text-center investor_btn">

                    <?php
                        $getlink = get_field('view_all_investors');
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
        </section><?php
    endif;
    ?>
    <section class="reverses reversenow topdec">
        <div class="container long">
            <?php get_template_part('template-parts/team', 'join'); ?>
        </div>
    </section>
       
    <section class="latest_blog nobefore">
        <div class="container long">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <?php get_template_part('template-parts/our', 'thinking'); ?>
        </div>
    </section>

<?php
// related resources widget
get_template_part('template-parts/related', 'resources-widget');

get_template_part('template-parts/demo', 'form');
get_footer(); ?>