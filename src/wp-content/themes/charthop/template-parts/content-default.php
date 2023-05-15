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

                    if (has_post_thumbnail()) :
                        ?><div class="single_custom_image w830">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'cs_single'); ?>" alt="" data-no-retina>
                        </div><?php
                    endif;

                    ?><div class="single_custom_text w830"><?php
                        the_content();
                    ?></div>
                </div>
            </div>
            <div class="col-md-4 "><?php

                $special_form = get_field('eif_form_shortcode');

                if (! empty($special_form))
                {
                    ?><div class="single_blog_sidebar w300 ebook">
                        <div class="purple_box forform"><?php
                        get_template_part(
                            'template-parts/form',
                            'download-guide',
                            [
                                'special_form'  =>  $special_form
                            ]
                        );
                        ?></div>
                    </div><?php
                }

                get_template_part('template-parts/resource', 'sidebar');

            ?></div>
        </div>
    </div>
</section>