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
        <h1><?php the_title(); ?></h1>
        <div class="single_blog_info"><?php
            echo get_the_date('M j, Y');

            if (get_field('rbs_read_time'))
            {
                echo '<span class="vdevide">|</span> <i class="fa fa-clock-o" aria-hidden="true"></i> ';
                echo 'Reading time: '.get_field('rbs_read_time').'min';
            }

        ?></div>

        <div class="row align-items-center single_blog_author no-gutters">
            <div class="col-auto"><?php

                $user_id = get_the_author_meta('ID');

                $author = get_user_by('ID', $user_id);
                $author_image = get_field('cs_photo', 'user_'.$user_id);
                if ($author_image) {
                    if (is_array($author_image))
                    {
                        $author_image = $author_image['url'];
                    }
                }
                else {
                    $author_image = get_avatar_url($user_id);
                }
                ?>
                <img src="<?php echo $author_image; ?>" alt="" data-no-retina>
            </div>
<!--            <div class="col-auto">BY --><?php //echo $author->display_name; ?><!--</div>-->
            <div class="col-auto blog_author_block">
                <h4>BY <?php echo $author->display_name; ?></h4>
                <?php the_field('job_position', 'user_' . $author->ID ); ?>
            </div>
        </div>

        <div class="single_blog_image">
            <img src="<?php echo get_the_post_thumbnail_url($post_id, 'blog-single'); ?>" alt="" data-no-retina>
            <div class="single_blog_imagetxt"><?php echo get_the_post_thumbnail_caption($post_id); ?></div>
        </div>
        <div class="row text_style">
            <div class="col-md-8 ">
                <div class="single_blog_text"><?php

                    the_content();
                    the_field('rbs_content_block');

                    // rbs_testimonial
                    if (! empty(get_field('ts_single_testimonial')))
                    {
                        get_template_part('template-parts/block', 'testimonial');
                    }


                    $gallery_imgs = get_field('rbs_gallery');

                    if (! empty($gallery_imgs)) :
                        ?><div class="row grid52 single_gallery"><?php

                            foreach ($gallery_imgs as $img) :

                                ?><div class="col-md-6">
                                    <a href="<?php echo $img['url']; ?>" data-fancybox data-caption="<?php echo $img['caption']; ?>">
                                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" data-no-retina>
                                    </a>
                                </div><?php

                            endforeach;

                        ?></div><?php
                    endif;

                    the_field('rbs_content_block2');


                    // related ebook
                    $related_ebooks = get_field('rbs_related_ebook');
                    if (! empty($related_ebooks)) :

                        foreach ($related_ebooks as $book) :

                            $book_types = wp_get_post_terms($book->ID, 'content_type');
                            $book_cats = wp_get_post_terms($book->ID, 'resource_category');

                            ?><div class="download_box"><?php

                                if (! empty($book_types) || ! empty($book_cats)) :

                                    ?><ul class="blog_tags row"><?php

                                        if (is_array($book_types)) {
                                            foreach ($book_types as $type)
                                            {
                                                echo '<li class="light"><a href="'
                                                    . get_category_link($type->term_id)
                                                    . '">' . $type->name . '</a></li>';
                                            }
                                        }

                                        if (is_array($book_cats)) {
                                            foreach ($book_cats as $cat)
                                            {
                                                echo '<li class="dark"><a href="'
                                                    . get_category_link($cat->term_id)
                                                    . '">' . $cat->name . '</a></li>';
                                            }
                                        }

                                    ?></ul><?php

                                endif;

                                ?><h3><a href="<?php echo get_permalink($book->ID); ?>"><?php echo $book->post_title; ?></a></h3>
                                <a href="<?php echo get_permalink($book->ID); ?>" class="button"><span>Download now</span></a>
                            </div><?php
                        endforeach;

                    endif;



                    // big image
                    $big_image = get_field('rbs_image_block_img');
//                    $big_image_link = get_field('rbs_image_block_link');

                    if (! empty($big_image)) :

                        ?><div class="row grid52 single_gallery">
                            <div class="col-12">
                                <a href="<?php echo $big_image['url']; ?>" data-fancybox data-caption="<?php echo $big_image['caption']; ?>">
                                    <img src="<?php echo $big_image['url']; ?>" alt="<?php echo $big_image['alt']; ?>" data-no-retina>
                                </a>
                            </div>
                        </div><?php

                    endif;

                    the_field('rbs_content_block3');

                    // CTA btn

                    $cta_btn = get_field('rbs_cta_button');
                    if (! empty($cta_btn)) {
                        if (! empty($cta_btn['target']))
                        {
                            echo '<a href="'
                                . $cta_btn['url'] . '" target="_blank" class="button"><span>'
                                . $cta_btn['title'] . '</span></a>';
                        }
                        else
                        {
                            echo '<a href="'
                                . $cta_btn['url'] . '" class="button"><span>'
                                . $cta_btn['title'] . '</span></a>';
                        }

                    }

                ?></div>
            </div>
            <div class="col-md-4 "><?php

                get_template_part('template-parts/resource', 'sidebar');

            ?></div>
        </div>
    </div>
</section>