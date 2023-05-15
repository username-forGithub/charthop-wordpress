<?php
$sign_in_link = get_field('sign_in', 'options');
$request_demo_link = get_field('request_a_demo', 'options');
$hide_watch_button = false;
$hide_nav_request_demo = false;
$hide_request_a_demo = false;
$hide_start_button = false;
if (is_archive())
{
    if (is_post_type_archive('platform'))
    {
        $hide_watch_button = get_field('pps_disable_watch_video_button', 'options') ?? false;
        $hide_nav_request_demo = get_field('pps_disable_request_a_demo_button_navigation', 'options') ?? false;
        $hide_request_a_demo = get_field('pps_disable_request_a_demo_button_hero_section', 'options') ?? false;
        $hide_start_button = get_field('pps_disable_start_free_trial_button', 'options') ?? false;
    }
    else if (is_post_type_archive('solutions'))
    {
        $hide_watch_button = get_field('sps_disable_watch_video_button', 'options') ?? false;
        $hide_nav_request_demo = get_field('sps_disable_request_a_demo_button_navigation', 'options') ?? false;
        $hide_request_a_demo = get_field('sps_disable_request_a_demo_button_hero_section', 'options') ?? false;
        $hide_start_button = get_field('sps_disable_start_free_trial_button', 'options') ?? false;
    }
    else if (is_post_type_archive('integrations'))
    {
        $hide_watch_button = get_field('disable_watch_video_button', 'options') ?? false;
        $hide_nav_request_demo = get_field('disable_request_a_demo_button_navigation', 'options') ?? false;
        $hide_request_a_demo = get_field('disable_request_a_demo_button_hero_section', 'options') ?? false;
        $hide_start_button = get_field('disable_start_free_trial_button', 'options') ?? false;
    }
}
else
{
    $hide_watch_button = get_field('disable_watch_video_button') ?? false;
    $hide_nav_request_demo = get_field('disable_request_a_demo_button_navigation') ?? false;
    $hide_request_a_demo = get_field('disable_request_a_demo_button_hero_section') ?? false;
    $hide_start_button = get_field('disable_start_free_trial_button') ?? false;
}

$hide_class_collections = [];

if ($hide_watch_button) {
    $hide_class_collections[] = 'hide_watch_button';
}

if ($hide_request_a_demo) {
    $hide_class_collections[] = 'hide_request_a_demo';
}

if ($hide_start_button) {
    $hide_class_collections[] = 'hide_start_button';
}

?><html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <title><?php bloginfo('name'); wp_title('|', true, 'left'); ?></title>

      <link rel="apple-touch-icon" sizes="76x76" href="<?php echo IMG; ?>/favicons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMG; ?>/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo IMG; ?>/favicons/favicon-16x16.png">
<!--      <link rel="manifest" href="--><?php //echo IMG; ?><!--/favicons/site.webmanifest">-->
      <link rel="mask-icon" href="<?php echo IMG; ?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
    
    <?php wp_head(); ?>
  </head><?php

  global $extra_body_class;

  if (! empty($extra_body_class))
  {
      $all_body_classes = array_push($hide_class_collections, $extra_body_class);
  } else {
      $all_body_classes = $hide_class_collections;
  }
  
  $post_type = get_post_type(); ?>
  
  <?php if ($post_type && $post_type == "platform" && ! is_archive()){
      
      if (! empty(get_field('asking_block')))
      {
          ?><body <?php body_class($all_body_classes); ?> data-spy='scroll' data-target='#navbar-example2' data-offset='500' data-hh="<?php echo $post_type; ?>"><?php
      }
      else
      {
          ?><body <?php body_class(array_merge(['singleproduct_body'], $all_body_classes)); ?> data-spy='scroll' data-target='#navbar-example2' data-offset='500' data-hh="<?php echo $post_type; ?>"><?php
      }

  } elseif ($post_type && $post_type == "solutions" && ! is_archive()){ ?>
        <body <?php body_class(array_merge(['our-solution-single'], $all_body_classes)); ?>>
   
  <?php } elseif (is_page_template('template-platform.php')) {
        ?><body <?php body_class(array_merge(['singleproduct_body'], $all_body_classes)); ?> data-spy='scroll' data-target='#navbar-example2' data-offset='500' data-hh="platform"><?php
  } else { ?>
      <body <?php body_class($all_body_classes); ?>>
  <?php }  ?>

  <?php
  $has_note = false;
  if (! empty(get_field('top_ribbon_text', 'options'))) :
      $has_note = true;
      ?><div class="top_note">
          <div class="top_note_close"></div>
          <div class="container">
              <div class="row no-gutters justify-content-center align-items-center">
                  <div class="col-lg-auto"><?php  the_field('top_ribbon_text', 'options'); ?></div>
                  <div class="col-lg-auto">
                      <?php
                      $getlink = get_field('top_ribbon_button', 'options');
                      if( $getlink ):
                          $link_url = $getlink['url'];
                          $link_title = $getlink['title'];
                          ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";
                          ?>
                          <a href="<?php echo $link_url; ?>" class="button" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo $link_title; ?></span></a>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div><?php
  endif;
  ?>
  <div class="mobile_menu">
      <div class="menu_header ">
          <div class="row align-items-center">
              <div class="col-auto">
                  <a href="/"><img src="<?php echo IMG; ?>/logo.svg" alt="" data-no-retina></a>
              </div>
              <div class="col">
                  <div class="mobile_menu_closer"></div>
              </div>
          </div>
      </div>
      <div class="mobile_menu_holder">
          <div class="back_mob"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</div>
          <?php
          wp_nav_menu(
              array(
                  'theme_location' => 'topmenu',
                  'container' => false,
//                  'menu_id'        => 'mobile-ul',
              )
          );
          ?>
          <div class="mobile_search"><?php

              $mobile_s_form = get_search_form(false);
              $mobile_s_form = str_replace('class="searchform', 'class="searchform row align-items-center no-gutters ', $mobile_s_form);
              $mobile_s_form = str_replace('<div>', '<div class="col">', $mobile_s_form);
              $mobile_s_form = str_replace('id="searchform"', 'id="searchform_mobile"', $mobile_s_form);
              $mobile_s_form = str_replace('value="Search">', 'value=""></button>', $mobile_s_form);
              $mobile_s_form = str_replace('<input type="submit"', '</div><div class="col-auto"><button type="submit" class="search_btn"', $mobile_s_form);
              echo $mobile_s_form;
              
          ?></div><?php
          if (! $hide_nav_request_demo && $request_demo_link) {
              ?><div class="mobile_bottom_btn">
                  <a href="<?php echo $request_demo_link; ?>" class="button"><span>Request a demo</span></a>
              </div><?php
          }
      ?></div>
  </div>
  <div class="mobile_menu_bgcloser"></div><?php 
  
  if ($has_note)
  {
      ?><header class="has_note"><?php
  }
  else
  {
      ?><header><?php
  }
  
  ?>
  <header>
      <div class="container">
          <div class="row">
              <div class="col-auto logohere header_start">
                <a href="/"><img src="<?php echo IMG; ?>/logo.svg" alt="" data-no-retina></a>
              </div>
              <div class="col header_center">
                  <?php
                  wp_nav_menu(
                      array(
                          'theme_location' => 'topmenu',
                          'container' => false,
                          'menu_class'        => 'headmenu',

                      )
                  );
              ?>
              </div>
              <div class="col col-lg-auto header_end<?php echo $hide_nav_request_demo? ' single': ''; ?>">
                  <div class="row align-items-center"><?php

                      // disable on mobile
                      if (! isMobileDevice())
                      {

                          if (! $hide_nav_request_demo && $request_demo_link) {
                              ?><div class="col-auto hide767 hideonsearch">
                              <a href="<?php echo $request_demo_link; ?>" class="button"><span>Request a demo</span></a>
                              </div><?php
                          }

                          if ($sign_in_link) :
                              ?><div class="col-auto hide767 hideonsearch">
                              <a href="<?php echo $sign_in_link; ?>" class="signin" data-label="Sign in">Sign in</a>
                              </div><?php
                          endif;
                          ?><div class="col-auto hide767">
                              <div class="search_holder">
                                  <div class="search_btn"></div>
                                  <div class="search_place"><?php
                                      get_search_form();
                                      ?></div>
                              </div>
                          </div><?php

                      }

                      ?><div class="col-auto show1200">
                          <div class="hamburger hamburger--spin js-hamburger">
                              <div class="hamburger-box">
                                  <div class="hamburger-inner"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header><?php

  if (is_singular('resources'))
  {
      $term_slugs = wp_get_post_terms(get_the_ID(), 'content_type', ['fields' =>  'slugs']);
      echo '<div class="page_wrap '.implode(' ', $term_slugs).'">';
  }
  else
  {
      ?><div class="page_wrap"><?php
  }

  ?>

