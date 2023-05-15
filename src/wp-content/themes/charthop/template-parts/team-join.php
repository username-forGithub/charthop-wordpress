<div class="row align-items-center">
    <div class="col-lg-6 col-xl order-2 order-lg-1">
        <div class="reverses_txt">
        <div class="label"><?php the_field('team_join_sup_text', 'options'); ?> </div>
        <h2><?php the_field('team_join_title', 'options'); ?> </h2>
        <p><?php the_field('team_join_text', 'options'); ?> </p>
        <a href="<?php the_field('team_join_link', 'options'); ?> " class="readmore">Join our team</a>
        </div>
    </div>
    <div class="col-lg-6 col-xl-auto order-1 order-lg-2">
        <div class="reverses_img">
            <img src="<?php the_field('team_join_image', 'options'); ?> " alt="" data-no-retina>
        </div>
    </div>
</div>