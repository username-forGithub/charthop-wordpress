<?php



/*
 * Note: pricing page pre-footer demo form section was integrated separately in template-pricing.php
 * */
$title = get_field('radfs_title', 'options');
$content = get_field('radfs_content', 'options');
$form_shortcode = get_field('radfs_shortcode', 'options');

if (! empty($form_shortcode)) :
    ?><section class="new-before_foot before_foot<?php

    if (isset($args['class']))
    {
        echo ' '.$args['class'];
    }

    ?>" id="demo_form_section">
        <div class="container long">
         <div class="row">
           <div class="col-md-6"><?php

                if ($title)
                {
                    echo "<h3>$title</h3>";
                }

                if ($content)
                {
                    echo $content;
                }

           ?></div>
           <div class="col-md-6 "><?php

               //echo do_shortcode($form_shortcode);
               get_template_part('template-parts/form', 'footer');

           ?></div>
         </div>
        </div>
    </section>
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div><?php
endif;