<?php
$no_related_items = true;
if (isset($args['resources'])) :

    if (! empty($args['resources'])) :
        $no_related_items = false;
        ?><div class="row">
            <div class="col-lg-5"><?php

                if (get_field('rs_title', 'options'))
                {
                    echo '<div class="label">' . get_field('rs_title', 'options') . '</div>';
                }

                if (get_field('rs_sub_title', 'options'))
                {
                    echo '<h2>'. get_field('rs_sub_title', 'options') .'</h2>';
                }

            ?></div><?php

            $link = get_field('rs_link', 'options');
            if (! empty($link)) :
                if ($link['target']) :
                    ?><div class="col-lg-7 align-self-end">
                        <div class="latest_blog_viewall">
                            <a href="<?php echo $link['url']; ?>" target="_blank" class="readmore"><?php echo $link['title']; ?></a>
                        </div>
                    </div><?php
                else:
                    ?><div class="col-lg-7 align-self-end">
                        <div class="latest_blog_viewall">
                            <a href="<?php echo $link['url']; ?>" class="readmore"><?php echo $link['title']; ?></a>
                        </div>
                    </div><?php
                endif;
            endif;

        ?></div><?php


        $content_types = get_terms('content_type', ['hide_empty' => false]);
        $content_links = [];
        foreach ($content_types as $type)  :
            $content_links[$type->term_id] = $type->name;
        endforeach;


        $categories = get_terms('resource_category', ['hide_empty' => false]);
        $category_links = [];
        foreach ($categories as $category)  :
            $category_links[$category->term_id] = $category->name;
        endforeach;


        ?><div class="row latest_blog_row grid52"><?php

            foreach ($args['resources'] as $resource) :
                $types = wp_get_post_terms($resource->ID, 'content_type', ['fields' => 'ids']);
                //var_dump($types, $resource->ID);
                $cats = wp_get_post_terms($resource->ID, 'resource_category', ['fields' => 'ids']);

                ?><div class="col-lg-4">
                    <div class="blog_box"><?php

                        if (! empty($types) || ! empty($cats)) :
                            ?><ul class="blog_tags row no-gutters"><?php

                            if (! empty($types)) {
                                echo '<li class="col-auto">';
                                foreach ($types as $type)
                                {
                                    echo '<a href="'.get_category_link($type).'">'.$content_links[$type].'</a>';
                                }
                                echo '</li>';
                            }

                            if (! empty($cats))
                            {
                                echo '<li class="col-auto">';
                                foreach ($cats as $cat)
                                {
                                    echo '<a href="'.get_category_link($cat).'" class="people-analytics">'.$category_links[$cat].'</a>';
                                }
                                echo '</li>';
                            }

                            ?></ul><?php
                        endif;

                        if (in_array('15', $types))
                        {
                            // customer story type id is 15
                            get_template_part(
                                'template-parts/resource',
                                'csimage',
                                [
                                    'title' =>  $resource->post_title,
                                    'link'  =>  get_permalink($resource->ID),
                                    'src'   =>  get_the_post_thumbnail_url($resource->ID, 'blog-post'),
                                    'color' =>  '#000000'
                                ]
                            );
                        }
                        // video type id is 13
                        else if (in_array('13', $types))
                        {
                            get_template_part(
                                'template-parts/resource',
                                'videoimage',
                                [
                                    'title' =>  $resource->post_title,
                                    'link'  =>  get_permalink($resource->ID),
                                    'src'   =>  get_the_post_thumbnail_url($resource->ID, 'blog-post')
                                ]
                            );
                        }
                        else
                        {
                            get_template_part(
                                'template-parts/resource',
                                'image',
                                [
                                    'title' =>  $resource->post_title,
                                    'link'  =>  get_permalink($resource->ID),
                                    'src'   =>  get_the_post_thumbnail_url($resource->ID, 'blog-post')
                                ]
                            );
                        }
                        ?>
                        <h3><a href="<?php echo get_permalink($resource->ID); ?>"><?php echo $resource->post_title; ?></a></h3>
                        <?php echo $resource->post_excerpt; ?>
                    </div>
                </div><?php

            endforeach;

        ?></div><?php

    endif;

endif;

if ($no_related_items)
{
    $related_resources = get_posts([
        'post_type'         =>  'resources',
        'posts_per_page'    =>  3
    ]);
    if (! empty($related_resources))
    {
        ?><div class="row">
            <div class="col-lg-5"><?php

            if (get_field('rs_title', 'options'))
            {
                echo '<div class="label">' . get_field('rs_title', 'options') . '</div>';
            }

            if (get_field('rs_sub_title', 'options'))
            {
                echo '<h2>'. get_field('rs_sub_title', 'options') .'</h2>';
            }

            ?></div><?php

            $link = get_field('rs_link', 'options');
            if (! empty($link)) :
                if ($link['target']) :
                    ?><div class="col-lg-7 align-self-end">
                    <div class="latest_blog_viewall">
                        <a href="<?php echo $link['url']; ?>" target="_blank" class="readmore"><?php echo $link['title']; ?></a>
                    </div>
                    </div><?php
                else:
                    ?><div class="col-lg-7 align-self-end">
                    <div class="latest_blog_viewall">
                        <a href="<?php echo $link['url']; ?>" class="readmore"><?php echo $link['title']; ?></a>
                    </div>
                    </div><?php
                endif;
            endif;

        ?></div><?php


        $content_types = get_terms('content_type', ['hide_empty' => false]);
        $content_links = [];
        foreach ($content_types as $type)  :
            $content_links[$type->term_id] = $type->name;
        endforeach;


        $categories = get_terms('resource_category', ['hide_empty' => false]);
        $category_links = [];
        foreach ($categories as $category)  :
            $category_links[$category->term_id] = $category->name;
        endforeach;

        ?><div class="row latest_blog_row grid52"><?php



        foreach ($related_resources as $resource) :
            $types = wp_get_post_terms($resource->ID, 'content_type', ['fields' => 'ids']);
            //var_dump($types, $resource->ID);
            $cats = wp_get_post_terms($resource->ID, 'resource_category', ['fields' => 'ids']);

            ?><div class="col-lg-4">
                <div class="blog_box"><?php

                    if (! empty($types) || ! empty($cats)) :
                        ?><ul class="blog_tags row no-gutters"><?php

                        if (! empty($types)) {
                            echo '<li class="col-auto">';
                            foreach ($types as $type)
                            {
                                echo '<a href="'.get_category_link($type).'">'.$content_links[$type].'</a>';
                            }
                            echo '</li>';
                        }

                        if (! empty($cats))
                        {
                            echo '<li class="col-auto">';
                            foreach ($cats as $cat)
                            {
                                echo '<a href="'.get_category_link($cat).'" class="people-analytics">'.$category_links[$cat].'</a>';
                            }
                            echo '</li>';
                        }

                        ?></ul><?php
                    endif;

                    if (in_array('15', $types))
                    {
                        // customer story type id is 15
                        get_template_part(
                            'template-parts/resource',
                            'csimage',
                            [
                                'title' =>  $resource->post_title,
                                'link'  =>  get_permalink($resource->ID),
                                'src'   =>  get_the_post_thumbnail_url($resource->ID, 'blog-post'),
                                'color' =>  '#000000'
                            ]
                        );
                    }
                    // video type id is 13
                    else if (in_array('13', $types))
                    {
                        get_template_part(
                            'template-parts/resource',
                            'videoimage',
                            [
                                'title' =>  $resource->post_title,
                                'link'  =>  get_permalink($resource->ID),
                                'src'   =>  get_the_post_thumbnail_url($resource->ID, 'blog-post')
                            ]
                        );
                    }
                    else
                    {
                        get_template_part(
                            'template-parts/resource',
                            'image',
                            [
                                'title' =>  $resource->post_title,
                                'link'  =>  get_permalink($resource->ID),
                                'src'   =>  get_the_post_thumbnail_url($resource->ID, 'blog-post')
                            ]
                        );
                    }
                    ?>
                    <h3><a href="<?php echo get_permalink($resource->ID); ?>"><?php echo $resource->post_title; ?></a></h3>
                    <?php echo $resource->post_excerpt; ?>
                </div>
            </div><?php

        endforeach;

        ?></div><?php
    }
}