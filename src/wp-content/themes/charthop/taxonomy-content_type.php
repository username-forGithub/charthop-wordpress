<?php

global $extra_body_class;

$cat_id = get_queried_object_id();
$cat = get_term_by('term_id', $cat_id, 'content_type');
$acf_key = 'content_type_' . $cat_id;

$template = get_field('cto_template', $acf_key);

if ($template == 'template2') {
    $extra_body_class = 'page-template-videos';
}

get_header();
$hide_section_1 = get_field('cto_shos', $acf_key);
$hide_section_2 = get_field('cto_shss', $acf_key);
$template = get_field('cto_template', $acf_key);
$extra_class = [];

if ($template == 'default')
{
    $extra_class[] = 'custom';
}
else if ($template == 'template2')
{
    $extra_class[] = 'videos';
}

$content_types = get_terms('content_type', ['hide_empty' => false]);
$content_links = [];

$categories = get_terms('resource_category', ['hide_empty' => false]);
$category_links = [];

    ?><section class="blog_top blog_top--mini">
        <div class="container long <?php echo implode(' ', $extra_class); ?>">
            <h1><?php echo $cat->name; ?></h1>
            <div class="blog_top_txt">
                <p><?php
                    echo $cat->description;
                ?></p>
            </div>

            <div class="row blog_nav filter_block">
                <div class="col-md-4 col-lg-auto">
                    <div class="label">SEARCH</div>
                    <input type="text" class="search" placeholder="Type in your search here…">
                </div><?php

                if (! empty($content_types)) :
//                    ?><!--<div class="col-md-4 col-lg-auto">-->
<!--                        <div class="label">CONTENT TYPE</div>-->
<!--                        <div class="select">-->
<!--                            <select id="content_type">-->
<!--                                <option value="all">All</option>--><?php

                                if (is_array($content_types)) :

                                    foreach ($content_types as $type)  :
                                        $content_links[$type->term_id] = $type->name;
//                                        if ($type->term_id != $cat_id) {
//                                            echo '<option value="'.$type->slug.'">'.$type->name.'</option>';
//                                        }
                                    endforeach;

                                endif;
//                            ?><!--</select>-->
<!--                        </div>-->
<!--                    </div>--><?php
                endif;



                if (! empty($categories)) : ?>

                    <div class="col-md-4 col-lg-auto">
                        <div class="label">Category</div>
                        <div class="select">
                            <select id="categories">
                                <option value="all">All</option><?php

                                if (is_array($categories)) :

                                    foreach ($categories as $category)  :
                                        $category_links[$category->term_id] = $category->name;
                                        echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
                                    endforeach;

                                endif;
                            ?></select>
                        </div>
                    </div><?php

                endif;

                ?><div class="col-md-12 col-lg-auto">
                    <div class="clear">Clear</div>
                </div>
            </div>

        </div>
    </section><?php

    $posts_per_page = get_option('posts_per_page');
    $loaded_posts = 0;
    $cur_page = 1;
    $resources = get_posts([
        'post_type' => 'resources',
        'posts_per_page'    =>  999,
        'tax_query' => [
            'relation'  => 'AND',
            [
                'taxonomy'  =>  'content_type',
                'field'     =>  'term_id',
                'terms'     =>  [ $cat_id ]
            ]
        ]
    ]);
    $total_page = ceil(count($resources) / $posts_per_page );

    if (! empty($resources)) :
        ?><div class="blog_body <?php echo implode(' ', $extra_class); ?>">
            <div class="container ">
                <div class="row latest_blog_row filter_results grid52"><?php

                    foreach ($resources as $resource) :

                        $types = wp_get_post_terms($resource->ID, 'content_type', ['fields' => 'ids']);
                        //var_dump($types, $resource->ID);
                        $cats = wp_get_post_terms($resource->ID, 'resource_category', ['fields' => 'ids']);

                        if (in_array(18, $types)) :
                            ?><div class="resource-single col-12">
                                <div class="feat_blog_box">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 order-2 order-lg-1">
                                            <div class="blog_box_txt"><?php
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
                                                endif; ?>
                                                <h3><a href="<?php echo get_permalink($resource->ID); ?>"><?php echo $resource->post_title; ?></a></h3>
                                                <a href="<?php echo get_permalink($resource->ID); ?>" class="readmore">Read more</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 order-1 order-lg-2">
                                            <div class="blog_box_image">
                                                <a href="<?php echo get_permalink($resource->ID); ?>">
                                                    <img src="<?php
                                                        echo get_the_post_thumbnail_url( $resource->ID, 'blog-post-feature' );
                                                    ?>" alt="" data-no-retina>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><?php
                        else :
                            ?><div class="resource-single col-md-6 col-lg-4">
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
                        endif;

                        $loaded_posts++;
                        if ($loaded_posts == $posts_per_page) {
                            $loaded_posts++;
                            break;
                        }
                    endforeach;

                    $extra_class2 = '';
                    if ($template == 'default')
                    {
                        $extra_class2 = 'resources';
                    }
                    else if ($template == 'template2')
                    {
                        $extra_class2 = 'videos';
                    }

                    if ($cur_page == 1 && $total_page == 1)
                    {
                        echo '<div class="col-12 blog_pages '.$extra_class2.' resource_pagination d-none" data-count="'.$posts_per_page.'" data-type="'.$cat_id.'" data-page="'.$cur_page.'" data-total="'.$total_page.'">';
                    }
                    else
                    {
                        echo '<div class="col-12 blog_pages '.$extra_class2.' resource_pagination" data-count="'.$posts_per_page.'" data-type="'.$cat_id.'" data-page="'.$cur_page.'" data-total="'.$total_page.'">';
                    }
                    if ($loaded_posts - 1 == $posts_per_page) :
                        $limit = 2;
                        $start = ($cur_page > 1)? $cur_page - 1: 0;
                        ?>

                        <a href="#" class="prev d-none"></a>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination"><?php

                                if ($total_page > 1)
                                {
                                    for ($i = 0; $i < $total_page; $i++)
                                    {
                                        if ($i > $cur_page + $limit)
                                        {
                                            echo '<span>...</span>';
                                            break;
                                        }
                                        else if ($i < $cur_page - $limit)
                                        {
                                            continue;
                                        }
                                        else
                                        {
                                            if ($i + 1 == $cur_page)
                                            {
                                                echo '<li><span class="current_page">'.($i+1).'</span></li>';
                                            }
                                            else
                                            {
                                                echo '<li><a href="#" class="pagination_link">'.($i+1).'</a></li>';
                                            }
                                        }
                                    }
                                }

                                ?></ul>
                        </nav>
                        <a href="#" class="next"></a>
                        <!--                            <span>Page <i class="current_page">1</i> of <i class="total_pages">--><?php //echo $total_page; ?><!--</i></span>-->
                        <?php
                    endif;
                    echo '</div>';
                ?></div>
            </div>
        </div><?php
    endif;

if (! $hide_section_1) :
    ?><section class="latest_blog">
        <div class="container long custom">
            <div class="circle1"></div>
            <div class="circle2"></div><?php
            get_template_part(
                'template-parts/our',
                'thinking', [
                    'content_links' => $content_links,
                    'category_links'   =>  $category_links
                ]
            );
        ?></div>
    </section><?php
endif;

if (! $hide_section_2) :
    get_template_part('template-parts/subscribe', 'form');
endif;

get_template_part('template-parts/demo', 'form');

get_footer();