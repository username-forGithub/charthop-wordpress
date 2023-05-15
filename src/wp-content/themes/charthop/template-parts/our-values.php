
    <div class="container long">
        <div class="row ">
        <div class="col-12">
            <h2><?php the_field('our_values_title', 'options'); ?></h2>
        </div>

        <?php
        if (have_rows('our_values_items', 'options')):
            while (have_rows('our_values_items', 'options')) : the_row();
        ?>        
        <div class="col-6 col-lg-3">
            <div class="value_box">
            <div class="value_box_icon">
                <img src="<?php the_sub_field('image'); ?> " alt="" data-no-retina>
            </div>
            <h4><?php the_sub_field('title'); ?> </h4>
            <p><?php the_sub_field('text'); ?> </p>
            </div>
        </div>   

        <?php endwhile; endif; ?>
        </div>
    </div>
