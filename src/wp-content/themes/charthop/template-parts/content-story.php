<?php

$post_id = get_the_ID();
$types = wp_get_post_terms($post_id, 'content_type');
$cats = wp_get_post_terms($post_id, 'resource_category');

?>
<section class="single_blog_content ptop ptop--mini">
    <div class="container long">

        <ul class="blog_tags row no-gutters"><?php

            if (!empty($types)) :
                echo '<li class="col-auto">';
                foreach ($types as $type):
                    echo '<a href="' . get_category_link($type->term_id) . '">' . $type->name . '</a>';
                endforeach;
                echo '</li>';
            endif;

            if (!empty($cats)) :
                echo '<li class="col-auto">';
                foreach ($cats as $cat):
                    echo '<a href="' . get_category_link($cat->term_id) . '" class="people-analytics">' . $cat->name . '</a>';
                endforeach;
                echo '</li>';
            endif;

            ?></ul>
        <div class="row text_style">
            <div class="col-md-8">
                <div class="w813">
                    <h1><?php the_title(); ?></h1><?php

                    $big_img = get_field('rcs_big_image');

                    if (!empty($big_img)) :

                        ?>
                        <div class="single_custom_image w830">
                        <img src="<?php echo $big_img['sizes']['cs_single']; ?>" alt="<?php echo $big_img; ?>"
                             data-no-retina>
                        </div><?php

                    endif;

                    // purple box for mobile
                    if (have_rows('rcs_customer_cards')) {
                        while (have_rows('rcs_customer_cards')) : the_row();
                            get_template_part(
                                'template-parts/purple',
                                'box',
                                [
                                    'logotype' => get_sub_field('logotype'),
                                    'founded' => get_sub_field('founded'),
                                    'industry' => get_sub_field('industry'),
                                    'type' => get_sub_field('type'),
                                    'number_of_employees' => get_sub_field('number_of_employees'),
                                    'distribution' => get_sub_field('distribution'),
                                    'mobile'    => true
                                ]
                            );
                        endwhile;
                    }

                    $show_hr = false;

                    ?><div class="single_custom_text w830"><?php

                        $qs_title = get_field('rcs_qs_title');
                        if ($qs_title) :
                            $show_hr = true;
                            echo '<h2>'. $qs_title .'</h2>';
                        endif;

                        if (have_rows('rcs_qs_questions')) :
                            $show_hr = true;
                            ?><div class="row ques_row "><?php

                            while (have_rows('rcs_qs_questions')) : the_row();
                                echo '<div class="col-md-6 col-lg-4">
                                    <div class="ques_box">'
                                    . get_sub_field('question')
                                    . '</div>
                                </div>';
                            endwhile;

                            ?></div><?php
                        endif;

                        $qs_content = get_field('rcs_qs_content');
                        if ($qs_content) :
                            $show_hr = true;
                            echo '<p>' . $qs_content . '</p>';
                        endif;

                        if ($show_hr)
                        {
                            echo '<hr>';
                            $show_hr = false;
                        }

                        $ps_content = get_field('rcs_ps_content');
                        if ($ps_content) {
                            echo $ps_content;
                            $show_hr = true;
                        }


                        $ps_style = get_field('rcs_ps_template');

                        if (have_rows('rcs_ps_items')) :
                            $show_hr = true;

                            ?><div class="client_icons_wrap">
                                <div class="row grid52 client_icons_title">
                                    <div class="col-auto"><h4><?php

                                        $ps_title = get_field('rcs_ps_title');
                                        echo ! empty($ps_title) ? $ps_title:  'Client was wasting:';

                                    ?></h4></div>
                                </div><?php

                                if ($ps_style == 'version1') :
                                    ?><div class="client_icons">
                                        <div class="row grid52"><?php

                                            $all_items = get_field('rcs_ps_items');

                                            $extra_class = 'col-6 col-lg-3';
                                            if (count($all_items) === 3)
                                            {
                                                $extra_class = 'col-6 col-lg-4';
                                            } elseif (count($all_items) === 2)
                                            {
                                                $extra_class = 'col-6';
                                            } elseif (count($all_items) === 1)
                                            {
                                                $extra_class = 'col-12';
                                            }

                                            while (have_rows('rcs_ps_items')) : the_row();
                                                $icon = get_sub_field('icon');
                                                $caption = get_sub_field('caption');
                                                ?><div class="<?php echo $extra_class; ?>">
                                                    <div class="client_icon_box">
                                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" data-no-retina>
                                                    </div>
                                                    <h5><?php echo $caption; ?></h5>
                                                </div><?php
                                            endwhile;

                                        ?></div>
                                    </div><?php
                                else :
                                    ?><div class="client_icons">
                                        <div class="row grid52"><?php
                                            while (have_rows('rcs_ps_items')) : the_row();
                                                $status = get_sub_field('status');
                                                $caption = get_sub_field('caption');
                                                ?><div class="col-6 col-lg-3">
                                                    <div class="client_purple"><?php
                                                        echo $status;
                                                    ?></div>
                                                    <h5><?php echo $caption; ?></h5>
                                                </div><?php
                                            endwhile;
                                        ?></div>
                                    </div><?php
                                endif;

                            ?></div><?php

                        endif;

                        if ($show_hr) {
                            echo '<hr>';
                        }


                        // testimonial block
                        get_template_part('template-parts/block', 'testimonial');


                        $ps_content = get_field('rcs_ps2_content');
                        if ($ps_content) {
                            echo $ps_content;
                        }

                        $ps_style = get_field('rcs_ps2_template');

                        if (have_rows('rcs_ps2_items')) :

                            ?><div class="client_icons_wrap">
                                <div class="row grid52 client_icons_title">
                                    <div class="col-auto"><h4><?php

                                        $ps_title = get_field('rcs_ps2_title');
                                        echo ! empty($ps_title) ? $ps_title:  'Now client can:';

                                    ?></h4></div>
                                </div><?php

                                if ($ps_style == 'version1') :
                                    ?><div class="client_icons">
                                        <div class="row grid52"><?php

                                            while (have_rows('rcs_ps2_items')) : the_row();
                                                $icon = get_sub_field('icon');
                                                $caption = get_sub_field('caption');
                                                ?><div class="col-6 col-lg-3">
                                                    <div class="client_icon_box">
                                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" data-no-retina>
                                                    </div>
                                                    <h5><?php echo $caption; ?></h5>
                                                </div><?php
                                            endwhile;

                                        ?></div>
                                    </div><?php
                                else :
                                    ?><div class="client_icons">
                                        <div class="row grid52"><?php
                                            while (have_rows('rcs_ps2_items')) : the_row();
                                                $status = get_sub_field('status');
                                                $caption = get_sub_field('caption');
                                                ?><div class="col-6 col-lg-3">
                                                    <div class="client_purple"><?php
                                                        echo $status;
                                                    ?></div>
                                                    <h5><?php echo $caption; ?></h5>
                                                </div><?php
                                            endwhile;
                                        ?></div>
                                    </div><?php
                                endif;

                            ?></div><?php

                            $link = get_field('rcs_ps2_button');
                            if ($link) {
                                if ($link['target'])
                                {
                                    echo '<a href="'.$link['url'].'" target="_blank" class="button"><span>'.$link['title'].'</span></a>';
                                }
                                else
                                {
                                    echo '<a href="'.$link['url'].'" class="button"><span>'.$link['title'].'</span></a>';
                                }
                            }

                        endif;

                    ?></div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="single_blog_sidebar w300 custom">
                    <div class="sidebar_rails">
                    <?php

                        // purple box for desktop
                        if (have_rows('rcs_customer_cards')) {
                            while (have_rows('rcs_customer_cards')) : the_row();
                                get_template_part(
                                    'template-parts/purple',
                                    'box',
                                    [
                                        'logotype' => get_sub_field('logotype'),
                                        'founded' => get_sub_field('founded'),
                                        'industry' => get_sub_field('industry'),
                                        'type' => get_sub_field('type'),
                                        'number_of_employees' => get_sub_field('number_of_employees'),
                                        'distribution' => get_sub_field('distribution'),
                                        'mobile'    => false
                                    ]
                                );
                            endwhile;
                        }

                    ?></div>
                    <div class="sidebar_other">
                        <div class="single_blog_sidebar_box">
                            <h3><?php

                                if (get_field('srs_share_block_title', 'options')) {
                                    echo get_field('srs_share_block_title', 'options');
                                } else {
                                    echo 'Share this article';
                                }

                                ?></h3>
                            <ul class="share">
                                <li><?php

                                    $tw_share_url = 'http://twitter.com/share?text='
                                        . get_the_title() . '&url='
                                        . get_permalink() . '&hashtags=ChartHop';

                                    ?><a href="<?php echo $tw_share_url; ?>" target="_blank">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li><?php

                                    $fb_share_url = 'https://www.facebook.com/sharer/sharer.php?u='
                                        . urlencode(get_permalink())
                                        . '&t="' . get_the_title();

                                    ?><a href="<?php echo $fb_share_url; ?>" target="_blank"
                                         onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li><?php

                                    $link_share = 'https://www.linkedin.com/sharing/share-offsite/?url=' . get_permalink();

                                    ?><a href="<?php echo $link_share; ?>" target="_blank">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php


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


                                    while (have_rows('rs_related_links')) : the_row();
                                        $link = get_sub_field('link');
                                        ?>
                                        <div class="col-6 col-md-12">
                                            <div class="related_sol">
                                                <h4><?php echo $link['title']; ?></h4>
                                                <a href="<?php echo $link['url']; ?>" class="readmore">Read more</a>
                                            </div>
                                        </div><?php
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



                        $download_shortcode = get_field('eif_form_shortcode');
//                        $file_url = get_field('rcs_download_file');

                        if (! empty($download_shortcode)) :
                            echo '<div class="single_blog_sidebar_box">';
//                            echo do_shortcode($download_shortcode);
                            get_template_part(
                                'template-parts/form',
                                'download-case',
                                [
                                    'special_form'  =>  $download_shortcode
                                ]
                            );
                             echo '</div>';

//                            if (! empty($file_url)) {
//                                echo '<div class="download-a" data-name="'.$file_url['filename'].'" data-url="'.base64_encode($file_url['url']).'"></div>';
//                            }
                        endif;
                    ?></div>


                </div>
            </div>
        </div>
    </div>
</section>