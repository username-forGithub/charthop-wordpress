<?php
/*
 * Template Name: Search
 * */

global $wp_query;

$cur_page = $_GET['paged'] ?? 1;
$posts_per_page = get_option('posts_per_page');

get_header();

    ?><section>
        <div class="container ptop">
            <div class="searh_content">
                <div class="label">SEARCH RESULTS</div>
                <h1>Results for “<?php echo $_GET['s']; ?>”</h1>
                <div class="searchpage_place"><?php
                    $search_form = get_search_form(false);
                    $search_form = str_replace('name="s"', 'name="s" placeholder="Search by keyword"', $search_form);
                    echo $search_form;
                ?></div>
                <div class="search_displaying"><?php

                    if ($wp_query->found_posts)
                    {
                        if ($wp_query->found_posts == $posts_per_page || $wp_query->found_posts > $posts_per_page)
                        {
                            echo 'Displaying '.($posts_per_page * $cur_page).' of '.$wp_query->found_posts.' results for "'.$_GET['s'].'"';
                        }
                        else
                        {
                            echo 'Displaying '.$wp_query->found_posts.' of '.$wp_query->found_posts.' results for "'.$_GET['s'].'"';
                        }
                    }
                    else {
                        echo '<div class="big_text"><p>Sorry, nothing was found.</p></div>';
                    }


                ?></div><?php

                if ($wp_query->found_posts > 0)
                {

                    if (have_posts()) :
                        while (have_posts()) : the_post();

                            ?><div class="search_result_line">
                                <ul class="blog_tags">
                                    <li><?php

                                        $content_type_terms = wp_get_post_terms(get_the_ID(), 'content_type');

                                        if (! empty($content_type_terms))
                                        {
                                            foreach ($content_type_terms as $term)
                                            {
                                                echo '<a href="'.get_category_link($term->term_id).'">'.$term->name.'</a>';
                                            }
                                        }

                                        if (! empty(get_post_type()))
                                        {
                                            if (get_post_type() != 'page')
                                            {
                                                echo '<a href="'
                                                    . esc_url(home_url(get_post_type())) . '" class="people-analytics" target="_blank">'
                                                    . get_post_type() . '</a>';
                                            }
                                            else
                                            {
                                                echo '<span class="post_type people-analytics">'
                                                    . get_post_type() . '</span>';
                                            }
                                        }

                                    ?></li>
                                </ul>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo get_the_excerpt(get_the_ID()); ?></p>
                            </div><?php

                        endwhile;
                    endif;

                    if ($posts_per_page < $wp_query->found_posts) :
                        ?><div class="search_pages row justify-content-center align-items-center"><?php

                            if ($cur_page > 1)
                            {
                                echo '<div class="col-auto">
                                    <a href="?s='.$_GET['s'].'&paged='.($cur_page - 1).'" class="sliderbtn prev"></a>
                                </div>';
                            }

                            ?><div class="col-auto">
                                <div class="search_pages_txt">
                                    Page <?php echo $cur_page; ?> of <?php echo ceil($wp_query->found_posts/$posts_per_page); ?>
                                </div>
                            </div><?php

                            if ($cur_page < ceil($wp_query->found_posts/$posts_per_page))
                            {
                                echo '<div class="col-auto">
                                    <a href="?s='.$_GET['s'].'&paged='.($cur_page + 1).'" class="sliderbtn"></a>
                                </div>';
                            }

                        ?></div><?php
                    endif;
                }

            ?></div>
            <div class="searh_decs"></div>
        </div>
    </section><?php


get_footer(); ?>