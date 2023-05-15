<?php

$post_id = get_the_ID();
$types = wp_get_post_terms($post_id, 'content_type');
$cats = wp_get_post_terms($post_id, 'resource_category');

?><section class="single_blog_content ptop single_blog_content--video ptop--mini">
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
        <div class="single_blog_info"><?php the_date('M j, Y'); ?></div>

        <div class="single_blog_image video"><?php

            $video_link = '';
            if (get_field('enable_youtube_video'))
            {
                $video_link = get_field('rvs_youtube_link');
            }
            else
            {
                $video_link = get_field('rvs_video_file');
            }

            if ($video_link) :
                ?><a data-fancybox href="<?php echo $video_link; ?>">
                    <span class="play">
                      <svg class="playicon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="73" viewBox="0 0 15.167 21">
                        <defs>
                          <clipPath id="clip-path">
                            <path id="Path_45" data-name="Path 45" d="M23.333-38.5a1.167,1.167,0,0,1,.693.228l.032.025L36.8-28.984l0,0,.018.014a1.167,1.167,0,0,1,.517.968,1.167,1.167,0,0,1-.524.973l-12.783,9.3a1.167,1.167,0,0,1-.693.228,1.167,1.167,0,0,1-1.167-1.167V-37.333A1.167,1.167,0,0,1,23.333-38.5Z" fill="#6e37ff" clip-rule="evenodd"/>
                          </clipPath>
                          <clipPath id="clip-path-2">
                            <path id="Path_44" data-name="Path 44" d="M-757,1258H683V-5320H-757Z"/>
                          </clipPath>
                        </defs>
                        <g id="Group_144" data-name="Group 144" transform="translate(-22.167 38.5)" clip-path="url(#clip-path)">
                          <g id="Group_143" data-name="Group 143" clip-path="url(#clip-path-2)">
                            <path id="Path_43" data-name="Path 43" d="M17.167-12.5H42.333v-31H17.167Z"/>
                          </g>
                        </g>
                      </svg>
                    </span>
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'video-single'); ?>" alt="" data-no-retina>
                </a><?php
            endif;

        ?></div>
        <div class="row text_style">
            <div class="col-md-8 ">
                <div class="single_blog_text"><?php the_content(); ?></div>
            </div>
            <div class="col-md-4 "><?php
                get_template_part('template-parts/resource', 'sidebar');
            ?></div>
        </div>
    </div>
</section>