<?php

$extra_class = $args['class'] ?? '';

if (isset($args['testimonials_id']) && isset($args['link_id']) && isset($args['acf_id'])) :
    $testimonials = [];
    if (isset($args['acf_id']))
    {
        $top_link = get_field($args['link_id'], $args['acf_id']);
        $testimonials = get_field($args['testimonials_id'], $args['acf_id']);
    }
    else
    {
        $top_link = get_field($args['link_id']);
        $testimonials = get_field($args['testimonials_id']);
    }
    if ($testimonials) :
        ?><section class="stories_carousel_sec <?php echo $extra_class; ?>">
            <div class="container"><?php

                if ($top_link) :
                    ?><div class="stories_carousel_btn"><?php
                        if ($top_link['target']) :
                            ?><a href="<?php echo $top_link['url']; ?>" target="_blank" class="readmore"><?php echo $top_link['title']; ?></a><?php
                        else :
                            ?><a href="<?php echo $top_link['url']; ?>" class="readmore"><?php echo $top_link['title']; ?></a><?php
                        endif;
                    ?></div><?php
                endif;


                ?><div class="stories_carousel_holder">
                    <div class="stories_carousel"><?php

                        foreach ($testimonials as $testimonial) :

                            if ($testimonial->post_content) :
                                $icon = get_field('company_logo', $testimonial->ID);

                                ?><div class="item">
                                <div class="carousel_box"><?php

                                    if (! empty($icon) && $extra_class != 'careers') :
                                        ?><div class="carousel_box_icon">
                                            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" data-no-retina>
                                        </div><?php
                                    endif;
                                    ?>
                                    <div class="carousel_box_text"><?php
                                        echo $testimonial->post_content;
                                        ?></div>
                                    <div class="row carousel_box_author align-items-center">
                                        <div class="col-auto"><?php

                                            if (has_post_thumbnail($testimonial->ID)) :
                                                ?><img src="<?php echo get_the_post_thumbnail_url($testimonial->ID, 'author'); ?>" alt="<?php echo $testimonial->post_title; ?>" data-no-retina><?php
                                            else :
                                                ?><img src="<?php echo IMG.'/user.png'; ?>" alt="<?php echo $testimonial->post_title; ?>" data-no-retina><?php
                                            endif;

                                        ?></div>
                                        <div class="col"><?php
                                            echo '<h4>'.get_the_title($testimonial->ID).'</h4>';

                                            the_field('author_position', $testimonial->ID);
                                            ?></div>
                                    </div><?php

                                    $link = get_field('link', $testimonial->ID);
                                    if (! empty($link) && $extra_class != 'careers')
                                    {
                                        if ($link['target'])
                                        {
                                            echo '<a href="'.$link['url'].'" target="_blank" class="readmore">'.$link['title'].'</a>';
                                        }
                                        else
                                        {
                                            echo '<a href="'.$link['url'].'" class="readmore">'.$link['title'].'</a>';
                                        }
                                    }
                                    ?>

                                </div>
                                </div><?php
                            endif;
                        endforeach;
                        ?>

                    </div>
                </div>
            </div>
        </section><?php
    endif;
endif;

?>