<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>


    <div class="container ptop ptop--mini">
        <section class="contact_top">
            <h1><?php echo get_field('title') ?? get_the_title(); ?> </h1>
            <?php

            if (! empty(get_field('subtitle'))) :
                ?><div class="contact_top_txt">
                    <p><?php the_field('subtitle'); ?> </p>
                </div><?php
            endif;

            //echo do_shortcode( '[contact-form-7 id="226" title="Contact page"]');
            get_template_part('template-parts/form', 'contact');
            ?>


        </section>
    </div>

<?php
    if (have_rows('info_items')): ?>
        <div class="as_feat_dec looking"></div>
        <section class="as_feat looking">
            <div class="container">
                <h2><?php the_field('info_title'); ?> </h2>
                <div class="row grid52">

                <?php

                        while (have_rows('info_items')) : the_row();
                ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="looking_box">
                            <h3><?php the_sub_field('item_title'); ?> </h3>
                            <p><?php the_sub_field('item_text'); ?> </p>
                            <?php
                                $getlink = get_sub_field('link');
                                if( $getlink ):
                                    $link_url = $getlink['url'];
                                    $link_title = $getlink['title'];
                                    ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";
                            ?>
                                    <a class="readmore" href="<?php echo $link_url; ?> " target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title ; ?></a>
                            <?php endif; ?>

                        </div>
                    </div>

                <?php endwhile; ?>

                </div>
            </div>
        </section><?php
    endif;

    get_template_part('template-parts/logos', 'trusted', ["hide" => true]);


    // related resources widget
    get_template_part('template-parts/related', 'resources-widget');

 get_footer(); ?>