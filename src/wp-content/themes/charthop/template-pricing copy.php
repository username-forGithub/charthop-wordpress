<?php
/*
 * Template Name: Pricing
 * */
get_header();


if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?><section class="blog_top">
            <div class="container long pricing">
                <h1><?php the_title(); ?></h1>

                <div class="blog_top_txt"><?php

                    the_content();

                ?></div>
            </div>
        </section><?php

        $plans = get_field('ps_choose_plans');
        $plans_table_head = '';
        $plans_table_body_plans_titles = '';
        $plans_table_body_plans_content = '';
        $plans_table_body_plans_feature = '';
        $plans_table_footer = '';

        $mobile_table_head = '';
        $mobile_table_body = '';
        $mobile_table_footer = '';

        if (! empty($plans) && is_array($plans)) {
            // mobile
            $mobile_table_head .= '
                <div class="pricing_table_mob show992">
                    <div class="container">';

            // desktop
            $plans_table_head .= '<div class="pricing_table_desk hide992">
                <div class="container long">
                    <div class="table_wrap price_table">';

            $plans_table_body_plans_titles .= '<div class="row no-gutters price_table_top">
                <div class="col colxyz align-self-end">
                    <div class="table_top_icon">
                        <img src="' . IMG . '/pricingdec2.svg" alt="" data-no-retina>
                    </div>
                </div>';
            $plans_table_body_plans_content .= '<div class="row no-gutters">
                <div class="col colxyz">
                    <div class="table_top_btn table_top_icon_title">
                        Features
                    </div>
                </div>';

            $plan_features = [];
            $plan_ids = [];


            // collection all features
            $all_features = get_terms([
                'taxonomy'      =>  'features',
                'hide_empty'    =>  'false',
                // 'orderby'       =>  'term_id',
                // 'order'         =>  'DESC'
            ]);

            $feature_mobile_htmls = [];
            foreach ( $all_features as $featt )
            {
                $feature_mobile_htmls[$featt->term_id] = '
                    <li>
                        <div class="row nowrap justify-content-between align-items-center">
                            <div class="col-auto">
                                <div class="mw212">' . $featt->name . '</div>
                            </div>
                            <div class="col-auto">
                                <div class="relative infoicon"></div>
                            </div>
                        </div>
                    </li>';
            }

            foreach ($plans as $plan)
            {
                // getting acf fields
                $p_info = get_field('pps_info', $plan);
                $p_price = get_field('pps_price', $plan);
                $p_title1 = get_field('pps_price_subtitle', $plan);
                $p_title2 = get_field('pps_price_subtitle_2', $plan);
                $p_link = get_field('pps_cta_button', $plan);
                array_push($plan_ids, $plan);

                // save feature ids to $plan_features
                $features = wp_get_post_terms($plan, 'features', ['fields' => 'ids', 'orderby'  =>  'term_id', 'order'  =>  'DESC']);
                if (is_array($features) && ! empty($features))
                {
                    $plan_features[] = $features;
                }

                // collecting table titles
                $plans_table_body_plans_titles .= '
                    <div class="col colxyz">
                        <div class="table_top text-center">
                            <h4>'.get_the_title($plan).'</h4>';
                if ($p_info)
                {
                    $plans_table_body_plans_titles .= '<strong>'.$p_info.'</strong>';
                }

                $plans_table_body_plans_titles .= '
                        </div>
                        <div class="table_top_body text-center">';
                if ($p_price)
                {
                    $plans_table_body_plans_titles .= '<h3>'.$p_price.'</h3>';
                }
                if ($p_title1)
                {
                    $plans_table_body_plans_titles .= '<p>'.$p_title1.'</p>';
                }
                if ($p_title2)
                {
                    $plans_table_body_plans_titles .= '<small>'.$p_title2.'</small>';
                }

                $plans_table_body_plans_titles .= '
                        </div>
                    </div>';

                // collecting table buttons
                $plans_table_body_plans_content .= '
                    <div class="col colxyz text-center">
                        <div class="table_top_btn">';
                if ($p_link) {
                    if ($p_link['target'])
                    {
                        $plans_table_body_plans_content .= '<a href="'.$p_link['url'].'" target="_blank" class="button"><span>'.$p_link['title'].'</span></a>';
                    }
                    else
                    {
                        $plans_table_body_plans_content .= '<a href="'.$p_link['url'].'" class="button"><span>'.$p_link['title'].'</span></a>';
                    }
                }
                $plans_table_body_plans_content .= '
                        </div>
                    </div>';


                // mobile
                $mobile_table_body .= '
                    <div class="pricing_box">
                        <div class="table_top text-center tl8">
                            <h4>'.get_the_title($plan).'</h4>';

                if ($p_info)
                {
                    $mobile_table_body .= '<strong>'. $p_info .'</strong>';
                }

                $mobile_table_body .= '
                        </div>
                        <div class="table_top_body text-center">';

                if ($p_price)
                {
                    $mobile_table_body .= '<h3>'. $p_price .'</h3>';
                }

                if ($p_title1)
                {
                    $mobile_table_body .= '<p>'.$p_title1.'</p>';
                }

                if ($p_title2)
                {
                    $mobile_table_body .= '<small>'.$p_title2.'</small>';
                }


                $mobile_table_body .= '
                        </div>
                        <div class="table_top_btn text-center">';

                if ($p_link) {
                    if ($p_link['target'])
                    {
                        $mobile_table_body .= '<a href="'.$p_link['url'].'" target="_blank" class="button"><span>'.$p_link['title'].'</span></a>';
                    }
                    else
                    {
                        $mobile_table_body .= '<a href="'.$p_link['url'].'" class="button"><span>'.$p_link['title'].'</span></a>';
                    }
                }

                $mobile_table_body .= '
                        </div>
                        <ul class="pricing_list">';

                foreach ($features as $f)
                {
                    if ($f == 28) continue;
                    $mobile_table_body .= $feature_mobile_htmls[$f];
                }

                $mobile_table_body .= '
                        </ul>
                        <div class="show_pricing">
                            See plan features
                        </div>
                    </div>';
            }


//            var_dump($plan_features);

            if (is_array($all_features) && !empty($all_features))
            {

                foreach ($all_features as $feat)
                {
                    $plans_table_body_plans_feature .= '<div class="row no-gutters">';
                    // acf link
                    $link = get_field('fts_cta_button', 'features_' . $feat->term_id);
                    $subtitle = get_field('fts_sub_title', 'features_' . $feat->term_id);
                    // add current feature title & popup
                    $plans_table_body_plans_feature .= '
                        <div class="col colxyz">
                            <div class="table_cell">';
                    if ($subtitle)
                    {
                        $plans_table_body_plans_feature .= '
                                    <h3>'.$feat->name.'</h3><p>'.$subtitle.'</p>';
                        if (! empty($feat->description) || !empty($link))
                        {
                            $plans_table_body_plans_feature .= '
                                <div class="relative infoicon infoicon--table"></div>
                                <div class="table_note table_note--table">
                                    <div class="relative">
                                        <div class="close"></div>
                                    </div>
                                    <h4>'.$feat->name.'</h4>';

                            if ($feat->description)
                            {
                                $plans_table_body_plans_feature .= '<p>'.$feat->description.'</p>';
                            }

                            if ($link)
                            {
                                if ($link['target'])
                                {
                                    $plans_table_body_plans_feature .= '<a href="'.$link['url'].'" target="_blank" class="readmore white">'.$link['title'].'</a>';
                                }
                                else
                                {
                                    $plans_table_body_plans_feature .= '<a href="'.$link['url'].'" class="readmore white">'.$link['title'].'</a>';
                                }
                            }
                            $plans_table_body_plans_feature .= '
                                </div>';
                        }
                    }
                    else
                    {
                        $plans_table_body_plans_feature .= '
                            <div class="row justify-content-between align-items-center nowrap no-gutters">
                                <div class="col-auto">
                                    <div class="mw212">'.$feat->name.'</div>';
                    }
                    $plans_table_body_plans_feature .= '</div>';

                    if (! $subtitle && (! empty($feat->description) || !empty($link)))
                    {
                        $plans_table_body_plans_feature .= '
                            <div class="col-auto ">
                                <div class="relative infoicon"></div>
                                <div class="table_note">
                                    <div class="relative">
                                        <div class="close"></div>
                                    </div>
                                    <h4>'.$feat->name.'</h4>';

                        if ($feat->description)
                        {
                            $plans_table_body_plans_feature .= '<p>'.$feat->description.'</p>';
                        }

                        if ($link)
                        {
                            if ($link['target'])
                            {
                                $plans_table_body_plans_feature .= '<a href="'.$link['url'].'" target="_blank" class="readmore white">'.$link['title'].'</a>';
                            }
                            else
                            {
                                $plans_table_body_plans_feature .= '<a href="'.$link['url'].'" class="readmore white">'.$link['title'].'</a>';
                            }
                        }
                        $plans_table_body_plans_feature .= '
                                </div>
                            </div>';
                    }
                    // if we use $subtitle we should remove .row div
                    if ($subtitle){
                        $plans_table_body_plans_feature .= '
                        </div>';
                    }
                    else
                    {
                        $plans_table_body_plans_feature .= '
                                </div>
                            </div>
                        </div>';
                    }

                    for ($i = 0; $i < count($plan_features); $i++)
                    {
                        // add tick if plan has current feature
                        if (in_array($feat->term_id, $plan_features[$i]))
                        {
                            if ($feat->term_id == 28)
                            {
                                $plan_feat_price = get_field('scp_price', $plan_ids[$i]);
                                $plan_feat_subtitle = get_field('scp_price_subtitle', $plan_ids[$i]);
                                $plans_table_body_plans_feature .= '
                                    <div class="col colxyz text-center">
                                        <div class="table_cell">';

                                if ($plan_feat_price || $plan_feat_subtitle)
                                {
                                    if ($plan_feat_price)
                                    {
                                        $plans_table_body_plans_feature .= '<div class="dollar">'.$plan_feat_price.'</div>';
                                    }

                                    if ($plan_feat_subtitle)
                                    {
                                        $plans_table_body_plans_feature .= '<small>'.$plan_feat_subtitle.'</small>';
                                    }
                                }
                                else
                                {
                                    $plans_table_body_plans_feature .= '<img class="center_element" src="'.IMG.'/tick-icon.svg" alt="" data-no-retina>';
                                }

                                $plans_table_body_plans_feature .= '
                                        </div>
                                    </div>';
                            }
                            else
                            {
                                $plans_table_body_plans_feature .= '
                                    <div class="col colxyz text-center">
                                        <div class="table_cell">
                                            <img class="center_element" src="'.IMG.'/tick-icon.svg" alt="" data-no-retina>
                                        </div>
                                    </div>';
                            }
                        }
                        else
                        {
                            $plans_table_body_plans_feature .= '
                                <div class="col colxyz text-center">
                                    <div class="table_cell"></div>
                                </div>';
                        }
                    }
                    $plans_table_body_plans_feature .= '</div><!-- .row no-gutters -->';
                }


            }

            // mobile
            $mobile_table_footer .= '
                    </div>
                </div>';


            // desktop
            $plans_table_body_plans_titles .= '</div>';
            $plans_table_body_plans_content .= '</div>';

            $plans_table_footer .= '</div><div class="table_dec"></div>';
            if (get_field('ps_notice_text')) {
                $plans_table_footer .= '<div class="after_table">'.get_field('ps_notice_text').'</div>';

                $mobile_table_footer = '<div class="after_table">*Additional integration fees may apply. For every employee in your organization, annual agreements for Standard start at $9,600, and for Premium at $21,600. Custom branded exports available for an additional fee</div>' . $mobile_table_footer;
            }
            $plans_table_footer .= '</div></div>';

        }


        // price table mobile
        echo $mobile_table_head
            . $mobile_table_body
            . $mobile_table_footer;

        // price table desktop
        echo $plans_table_head .
            $plans_table_body_plans_titles .
            $plans_table_body_plans_content .
            $plans_table_body_plans_feature .
            $plans_table_footer;

    endwhile;
    wp_reset_postdata();
endif;



$faqs = get_field('ps_faqs_questions');

if (! empty($faqs) && is_array($faqs)) :

    ?><section class="pricing_faqs">
        <div class="container long">
            <div class="row">
                <div class="col-lg-4">
                    <div class="pricing_faqs_title"><?php

                        if (get_field('ps_faqs_title'))
                        {
                            echo '<h2>';
                            the_field('ps_faqs_title');
                            echo '</h2>';
                        }

                        if (get_field('ps_faqs_subtitle'))
                        {
                            echo '<p>';
                            the_field('ps_faqs_subtitle');
                            echo '</p>';
                        }

                    ?></div>
                </div>
                <div class="col-lg-8"><?php

                    foreach ($faqs as $faq)
                    {
                        echo '
                            <div class="question_box">
                                <div class="ques_box_title">'.$faq->post_title.'</div>
                                <div class="ques_box_text">'.$faq->post_content.'</div>
                            </div>';
                    }

                ?></div>
            </div>
        </div>
    </section><?php

endif;



if (have_rows('psc_customer_logos')) :

    ?><section class="trusted_by pricing">
        <div class="container"><?php
            if (get_field('psc_title'))
            {
                echo '<h2>'.get_field('psc_title').'</h2>';
            }
            ?><div class="row align-items-center"><?php

                while (have_rows('psc_customer_logos')) : the_row();

                    $link = get_sub_field('link');
                    $image = get_sub_field('logo');
                    echo '<div class="col-6 col-sm-4 col-lg-3 col-xl-2">';

                    if ($link['target'])
                    {
                        echo '<a href="'.$link['url'].'" target="_blank" class="proud_part_box">';
                    }
                    else
                    {
                        echo '<a href="'.$link['url'].'" class="proud_part_box">';
                    }

                    echo '<img src="'.$image['sizes']['medium'].'" alt="'.$image['alt'].'" data-no-retina>
                            </a>
                        </div>';
                endwhile;
                wp_reset_postdata();


                $cta_link = get_field('psc_bottom_cta');
                if (! empty($cta_link))
                {
                    if ($cta_link['target'])
                    {
                        echo '<div class="col-12 text-center">
                                <a href="'.$cta_link[ 'url' ].'" target="_blank" class="readmore">'. $cta_link['title'] .'</a>
                            </div>';
                    }
                    else
                    {
                        echo '<div class="col-12 text-center">
                                <a href="'.$cta_link[ 'url' ].'" class="readmore">'. $cta_link['title'] .'</a>
                            </div>';
                    }
                }


                ?>

            </div>
        </div>
    </section><?php

endif;

// related resources widget
get_template_part('template-parts/related', 'resources-widget');

get_template_part('template-parts/demo', 'form');

get_footer(); ?>