<?php
get_header();


?><div class="home_hero page404">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-2 order-md-1"><?php

                $title = get_field('error_403_title', 'options');

                if (! empty($title))
                {
                    echo '<div class="title404">';
                    echo $title;
                    echo '</div>';
                }

                the_field('error_403_content', 'options');

                if (have_rows('error_403_links', 'options'))
                {
                    while (have_rows('error_403_links', 'options')) : the_row();
                        $link = get_sub_field('link');

                        if ($link)
                        {
                            echo '<a href="'.$link['url'].'" class="readmore back white">'.$link['title'].'</a>';
                        }
                    endwhile;
                    wp_reset_postdata();
                }
                ?></div>
            <div class="col-md-6 order-1 order-md-2 text-center">
                <img src="<?php echo IMG; ?>/404dec.svg" alt="" data-no-retina>
            </div>
        </div>
    </div>
    </div><?php




get_footer();




