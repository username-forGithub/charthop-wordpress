<?php

$title = get_field('tpot_title', 'options');
$sub_title = get_field('tpot_big_subtitle', 'options');
$link = get_field('tpot_link', 'options');

if (! isset($args['content_links']))
{
    $content_types = get_terms('content_type', ['hide_empty' => false]);
    $content_links = [];
    foreach ($content_types as $type)  :
        $content_links[$type->term_id] = $type->name;
    endforeach;
    $args['content_links'] = $content_links;

    $categories = get_terms('resource_category', ['hide_empty' => false]);
    $category_links = [];
    foreach ($categories as $category)  :
        $category_links[$category->term_id] = $category->name;
    endforeach;
    $args['category_links'] = $category_links;
}



if ($title || $sub_title || $link) :

    ?><div class="row"><?php

        if (! empty($title) || ! empty($sub_title)) :
            ?><div class="col-lg-5"><?php

                if (! empty($title))
                {
                    if (is_tax('content_type')) {
                        $custom_title = get_field('cto_shos_title', 'content_type_' . get_queried_object_id());

                        echo '<div class="label">'. ($custom_title ?: $title) .'</div>';
                    } else {
                        echo '<div class="label">'.$title.'</div>';
                    }
                }

                if (! empty($sub_title))
                {
                    echo '<h2>'.$sub_title.'</h2>';
                }

            ?></div><?php
        endif;

        if ($link) :
            ?><div class="col-lg-7 align-self-end">
                <div class="latest_blog_viewall"><?php
                    if ($link['target'])
                    {
                        echo '<a href="'. $link['url'] .'" target="_blank" class="readmore">'. $link['title'] .'</a>';
                    }
                    else
                    {
                        echo '<a href="'. $link['url'] .'" class="readmore">'. $link['title'] .'</a>';
                    }

                ?></div>
            </div><?php
        endif;

    ?></div><?php

endif;


$latest_resources = get_posts([
    'posts_per_page'    =>  3,
    'post_type'         =>  'resources',
    'order_by'          =>  'date'
]);
if (! empty($latest_resources)) :
    ?><div class="row latest_blog_row grid52"><?php
        foreach ($latest_resources as $resource) :

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
                                echo '<a href="'.get_category_link($type).'">'.$args['content_links'][$type].'</a>';
                            }
                            echo '</li>';
                        }

                        if (! empty($cats))
                        {
                            echo '<li class="col-auto">';
                            foreach ($cats as $cat)
                            {
                                echo '<a href="'.get_category_link($cat).'" class="people-analytics">'.$args['category_links'][$cat].'</a>';
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
                    else if (in_array('13', $types))
                    {
                        // video type id is 13
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

else :

    ?><div class="row latest_blog_row grid52">
        <div class="col-lg-4">
            <div class="blog_box">
                <p>Blogs, videos, and ebooks have not been uploaded yet.</p>
            </div>
        </div>
    </div><?php

endif;
