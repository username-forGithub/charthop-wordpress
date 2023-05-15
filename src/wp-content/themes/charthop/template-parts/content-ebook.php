<?php

$post_id = get_the_ID();
$types = wp_get_post_terms($post_id, 'content_type');
$cats = wp_get_post_terms($post_id, 'resource_category');

?><section class="single_blog_content ptop ptop--mini">
    <div class="container long">

        <ul class="blog_tags row no-gutters"><?php

            if (! empty($types)) :
                echo '<li class="col-auto">';
                foreach ($types as $type):
                    echo '<a href="'. get_category_link($type->term_id) .'">'. $type->name .'</a>';
                endforeach;
                echo '</li>';
            endif;

            if (! empty($cats)) :
                echo '<li class="col-auto">';
                foreach ($cats as $cat):
                    echo '<a href="'. get_category_link($cat->term_id) .'" class="people-analytics">'. $cat->name .'</a>';
                endforeach;
                echo '</li>';
            endif;

        ?></ul>
        <div class="row text_style">
            <div class="col-md-8 ">
                <div class="w813">
                    <h1><?php the_title(); ?></h1><?php

                    if (has_post_thumbnail())
                    {
                        ?><div class="single_custom_image w830">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'cs_single'); ?>" alt="<?php the_title(); ?>" data-no-retina>
                        </div><?php
                    }

                    ?>

                    <div class="single_custom_text integ w830"><?php

                        the_content();


                        if (get_field('ts_single_testimonial'))
                        {
                            get_template_part('template-parts/block', 'testimonial');
                        }

                    ?></div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="single_blog_sidebar w300 ebook">
                    <?php

//                    $form_shortcode = get_field('dfes_shortcode', 'options');
//                    $download_file = get_field('res_download_file');
//
//                    if (! empty($form_shortcode) && ! empty($download_file)) :



                        $special_form = get_field('eif_form_shortcode');

                        if (! empty($special_form))
                        {
                            ?><div class="purple_box forform"><?php
                            get_template_part(
                                'template-parts/form',
                                'download-guide',
                                [
                                    'special_form'  =>  $special_form
                                ]
                            );
                            ?></div><?php
                        }
//                        else
//                        {
//                            get_template_part('template-parts/form', 'download-guide');
//                        }

//                            echo do_shortcode($form_shortcode);
//
//                            if (! empty($download_file)) {
//                                echo '<div class="download-a" data-name="'.$download_file['filename'].'" data-url="'.base64_encode($download_file['url']).'"></div>';
//                            }



//                    endif;

                    ?><div class="pl30_ondesk"><?php

                        $rel_solutions = get_field('rs_related_solutions');

                        if (!empty($rel_solutions)) :
                            ?>
                            <div class="single_blog_sidebar_box">
                            <h3>Related solutions</h3><?php

                            foreach ($rel_solutions as $solution) :

                                ?>
                                <div class="related_sol">
                                <h4><?php echo $solution->post_title; ?></h4>
                                <p><?php echo get_the_excerpt($solution->ID); ?></p>
                                <a href="<?php echo get_permalink($solution->ID); ?>" class="readmore">Read more</a>
                                </div><?php

                            endforeach;

                            ?></div><?php
                        endif;

                        if (have_rows('rs_related_links')) :

                            ?>
                            <div class="single_blog_sidebar_box">
                                <h3>Related links</h3>

                                <div class="row"><?php
                                    $i = 0;
                                    while (have_rows('rs_related_links')) : the_row();
                                        $link = get_sub_field('link');
                                        ?><div class="col-6 col-md-12 <?php echo $i > 0? 'mt-4': ''; ?>">
                                            <div class="related_sol">
                                                <h4><?php echo $link['title']; ?></h4>
                                                <a href="<?php echo $link['url']; ?>" class="readmore">Read more</a>
                                            </div>
                                        </div><?php
                                        $i++;
                                    endwhile;

                                ?></div>

                            </div><?php

                        endif;

                        $get_in_touch_content = get_field('srs_get_in_touch', 'options');
                        $get_in_touch_link = get_field('srs_get_in_touch_button', 'options');

                        if (!empty($get_in_touch_content) || !empty($get_in_touch_link)) :

                            ?><div class="single_blog_sidebar_box"><?php

                            echo $get_in_touch_content;

                            ?><a href="<?php echo $get_in_touch_link['url']; ?>" <?php
                            if ($get_in_touch_link['target']) {
                                echo 'target="_blank"';
                            }
                            ?> class="button"><span><?php
                                echo $get_in_touch_link['title'];
                                ?></span></a>
                            </div><?php
                        endif;

                    ?></div>
                </div>
            </div>
        </div>
    </div>
</section>