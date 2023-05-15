<?php

/*
  * Template Name: Leadership
  * */
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <section class="blog_top blog_top--mini">
            <div class="container long team">
                <h1><?php ! empty(get_field('title'))? the_field('title'): the_title(); ?></h1><?php

                if (! empty(get_field('subtitle')) ):
                  ?><div class="blog_top_txt">
                    <p><?php the_field('subtitle'); ?> </p>
                  </div><?php
                endif;?>

            </div>
        </section>

        <div class="container long team_row">
            <div class="row grid52">

                <?php $count = 1;
                if (have_rows('team_member')):
                    while (have_rows('team_member')) : the_row();
                        ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="team_box">
                                <a href="#modal-<?php echo $count; ?>" class="team_box_img">
                                    <img src="<?php the_sub_field('image'); ?> " alt="" data-no-retina>
                                </a>
                                <h4><a href="#modal-1"><?php the_sub_field('full_name'); ?> </a></h4>
                                <p><?php the_sub_field('job_title'); ?></p><?php

                                if (get_sub_field('linkedin') || get_sub_field('twitter')) :
                                    ?>
                                    <ul><?php

                                        if (get_sub_field('linkedin')) : ?>
                                            <li>
                                                <a href="<?php the_sub_field('linkedin'); ?>" target="_blank">
                                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                </a>
                                            </li><?php
                                        endif;

                                        if (get_sub_field('twitter')) :
                                            ?>
                                            <li>
                                                <a href="<?php the_sub_field('twitter'); ?>" target="_blank">
                                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                                </a>
                                            </li><?php
                                        endif;
                                    ?></ul><?php
                                endif;
                            ?></div>
                        </div>
                        <?php $count++;
                    endwhile;
                endif; ?>

            </div>
        </div>


        <?php $count1 = 1;
            if (have_rows('team_member')):
                while (have_rows('team_member')) : the_row();
        ?>

        <div class="remodal" data-remodal-id="modal-<?php echo $count1; ?>">
            <button data-remodal-action="close" class="remodal-close"></button>
            <div class="remodal_inside">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <div class="team_box_img">
                    <img src="<?php the_sub_field('image'); ?>" alt="" data-no-retina>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="remodal_inside_top">
                    <h4><?php the_sub_field('full_name'); ?></h4>
                    <p><?php the_sub_field('job_title'); ?></p>
                    <ul>
                      <li>
                        <a href="<?php the_sub_field('linkedin'); ?>" target="_blank">
                          <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php the_sub_field('twitter'); ?>" target="_blank">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-12 remodal_inside_bottom">
                  <div class="row grid52">

                    <?php if (have_rows('popup_item')):
                            while (have_rows('popup_item')) : the_row();
                    ?>

                        <div class="col-md-4">
                            <h5><?php the_sub_field('title1'); ?></h5>
                            <p><?php the_sub_field('text'); ?></p>
                        </div>

                    <?php endwhile; endif; ?>

                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php $count1++; endwhile; endif; ?> <?php
    endwhile;
    wp_reset_postdata();
endif;?>

    <section class="reverses reversenow dec">
        <div class="container long">
            <?php get_template_part('template-parts/team', 'join'); ?>
        </div>
    </section>

<?php


// related resources widget
get_template_part('template-parts/related', 'resources-widget');

get_template_part('template-parts/demo', 'form'); ?>
<?php get_footer();?>