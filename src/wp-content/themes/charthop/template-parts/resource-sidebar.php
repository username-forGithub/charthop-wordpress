<div class="single_blog_sidebar">

    <div class="single_blog_sidebar_box">
        <h3><?php

        if (get_field('srs_share_block_title', 'options'))
        {
            echo get_field('srs_share_block_title', 'options');
        }
        else
        {
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
                    . '&t="'.get_the_title();

                ?><a href="<?php echo $fb_share_url; ?>" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
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
    </div><?php


    $rel_solutions = get_field('rs_related_solutions');

    if (! empty($rel_solutions)) :
        ?><div class="single_blog_sidebar_box">
            <h3>Related solutions</h3><?php

            foreach ($rel_solutions as $solution) :

                ?><div class="related_sol">
                    <h4><?php echo $solution->post_title; ?></h4>
                    <p><?php echo get_the_excerpt($solution->ID); ?></p>
                    <a href="<?php echo get_permalink($solution->ID); ?>" class="readmore">Read more</a>
                </div><?php

            endforeach;

        ?></div><?php
    endif;



    if (have_rows('rs_related_links')) :
        $rel_links_html = '';

        while (have_rows('rs_related_links')) : the_row();
            $link = get_sub_field('link');
            if ($link) :
                $rel_links_html .= '<div class="col-6 col-md-12">
                    <div class="related_sol">
                        <h4>' . $link['title'] . '</h4>
                        <a href="' . $link['url'] . '" class="readmore">Read more</a>
                    </div>
                </div>';
            endif;
        endwhile;

        if (! empty($rel_links_html)) :
            ?><div class="single_blog_sidebar_box">
                <h3>Related links</h3><div class="row"><?php

                echo $rel_links_html;

                ?></div>
            </div><?php
        endif;

    endif;

    $get_in_touch_content = get_field('srs_get_in_touch', 'options');
    $get_in_touch_link = get_field('srs_get_in_touch_button', 'options');

    if (! empty($get_in_touch_content) || ! empty($get_in_touch_link)) :
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