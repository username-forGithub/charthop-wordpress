<?php
$testimonials = get_field('ts_single_testimonial');

if (! empty($testimonials)) :

    foreach ($testimonials as $i => $testimonial) :
        echo $i > 0? '<hr>': '';
        ?><blockquote><?php

            echo strip_tags($testimonial->post_content, '');

            ?><div class="row box_author align-items-center"><?php


            if (has_post_thumbnail($testimonial->ID)) :

                ?><div class="col-auto">
                    <img src="<?php echo get_the_post_thumbnail_url($testimonial->ID); ?>" alt="<?php echo $testimonial->post_title; ?>" data-no-retina>
                </div><?php

            else :

                ?><div class="col-auto">
                    <img src="<?php echo IMG . '/user.png'; ?>" alt="<?php echo $testimonial->post_title; ?>" data-no-retina>
                </div><?php

            endif;

            ?><div class="col"><?php

            echo '<h4>'. $testimonial->post_title .'</h4>';
            the_field('author_position', $testimonial->ID);

            ?></div>
            </div>
        </blockquote><?php

    endforeach;

endif;