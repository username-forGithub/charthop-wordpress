<?php get_header(); 

if (have_posts()) :
    while (have_posts()) : the_post();
        $types = wp_get_post_terms(get_the_ID(), 'content_type', ['fields' => 'ids']);

        if (! empty($types))
        {
            if ($types[0] == 12) {
                // blog
                get_template_part('template-parts/content', 'blog');
            } else if ($types[0] == 15) {
                
                // customer story
                get_template_part('template-parts/content', 'story');
            } else if ($types[0] == 13) {
                // video
                get_template_part('template-parts/content', 'video');
            }  else if ($types[0] == 19) {
                // video
                get_template_part('template-parts/content', 'ebook');
            } else {
                // default
                get_template_part('template-parts/content', 'default');
            }
        }
        else
        {
            // default
            get_template_part('template-parts/content', 'default');
        }

        $rel_resources = get_field('rbs_related_resources');

        //if (! empty($rel_resources)) :

            ?><section class="latest_blog singlestyle custom">
                <div class="container long">
                    <div class="circle1"></div>
                    <div class="circle2"></div><?php

                    get_template_part('template-parts/related', 'resources', [
                        'resources' =>  $rel_resources
                    ]);

                ?></div>
            </section><?php
        //endif;
    endwhile;
    wp_reset_postdata();
endif;

//if ( $types[0] != 12 ) :
//    ?><!--<section class="latest_blog singlestyle">-->
<!--        <div class="container long">-->
<!--            <div class="circle1"></div>-->
<!--            <div class="circle2"></div>--><?php
//            get_template_part('template-parts/our', 'thinking');
//        ?><!--</div>-->
<!--    </section>--><?php
//endif;

if (!empty($types))
{
    if ( $types[0] == 12 ) :
        get_template_part('template-parts/subscribe', 'form');
    endif;
}

// related resources widget
get_template_part('template-parts/related', 'resources-widget');
get_template_part('template-parts/demo', 'form');

get_footer(); ?>