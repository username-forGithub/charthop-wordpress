<?php get_header();?>
      <div class="home_hero_light_wrap">
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
                    <a data-fancybox href="<?php the_field('top_banner_video'); ?> ">
                      Watch video
                      <span>(<?php  the_field('video_duration'); ?>)</span>
                    </a>
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
            <div class="light_dec"></div>

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
      </div>

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

    <section class="platform_mobile show1200">
        <div class="container long">
            <div class="row align-items-center">
                <?php                    
                if (have_rows('scroll_section')):
                    while (have_rows('scroll_section')) : the_row();
                ?> 
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="solubox">
                            <div class="solubox_height">
                            <h3><?php echo get_sub_field('title'); ?></h3>
                            <p><?php echo get_sub_field('text'); ?></p>
                            </div>
                        </div>
                    </div> 
                <?php endwhile; else : endif; ?>
               
            </div>
        </div>
    </section>

    <section class="amazing_scroll hide1200">
        <div class="container">
            <div class="row">
            <div class="amazing_list_col">
                <div class="amazing_list" id="navbar-example2">
                <ul>
                    <?php
                        $count_title = 1;
                        if (have_rows('scroll_section')):
                            while (have_rows('scroll_section')) : the_row();
                    ?>   
                                <?php if($count_title == 1){ ;?>
                                    <li>
                                        <a class="nav-link active" href="<?php echo $count_title; ?>"><?php echo get_sub_field('title'); ?> </a>
                                    </li>
                                <?php } else { ;?>
                                    <li>
                                        <a class="nav-link" href="<?php echo $count_title; ?>"><?php echo get_sub_field('title'); ?> </a>
                                    </li>
                                <?php } ;?>
                        <?php $count_title++; ?>
                    <?php endwhile; else : endif; ?>

                </ul>
                </div>
            </div>
            <div class="amazing_body" >
                <div class="fade_top"></div>

                <?php
                    $count_body = 1;
                    if (have_rows('scroll_section')):
                        while (have_rows('scroll_section')) : the_row();
                ?> 
                    <div class="amazing_body_line">
                        <h2 id="id<?php echo $count_body; ?>"><?php echo get_sub_field('title'); ?></h2>
                        <p><?php echo get_sub_field('text'); ?></p>
                    </div>
                    <?php $count_body ++ ;?>
                <?php endwhile; else : endif; ?>

                <div class="fade_bottom"></div>
            </div> 
            </div>
        </div>
        <div class="amazing_side_holder">
            <div class="amazing_side">
            <div class="amazing_side_image">
                <img src="<?php the_field('scroll_section_image'); ?> " alt="">
            </div>
            </div>
        </div>
    </section>
    
      <?php

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


    if (! empty(get_field('asking_block'))) :
        ?>
        <div class="asking_block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="order-2 order-lg-1 col-lg-6 col-xl-4">
                        <h3><?php the_field('asking_block'); ?> </h3>

                        <?php
                        $getlink = get_field('asking_link');
                        if( $getlink ):
                            $link_url = $getlink['url'];
                            $link_title = $getlink['title'];
                            ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";
                        ?>
                            <a class="readmore" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
                        <?php endif; ?>

                    </div><?php

                    if (get_field('asking_image')) :

                        ?><div class="order-1 order-lg-2 col-lg-6 col-xl-8">
                            <div class="asking_block_image">
                                <img src="<?php the_field('asking_image'); ?> " alt="" data-no-retina>
                            </div>
                        </div><?php

                    endif;
                ?></div>
            </div>
        </div>
        <?php
    endif;
    
    get_template_part('template-parts/demo', 'form'); ?>
           
<?php get_footer();?>