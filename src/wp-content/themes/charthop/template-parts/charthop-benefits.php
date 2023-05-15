<section class="benefit_sec">
    <div class="container2">
        <div class="row align-items-center">
            <div class="col-lg-6 relative">
                <div class="benefit_sec_img"><?php

                    if (get_field('charthop_benefits_image', 'options'))
                    {
                        echo wp_get_attachment_image(get_field('charthop_benefits_image', 'options'), 'full');
                    }

                    ?>
<!--                    <img src="--><?php //; ?><!--" alt="" data-no-retina>-->
                </div>
            </div>
        </div>
    </div>
    <div class="container container1">
        <div class="row">
            <div class="col-lg-6 ">

            </div>
            <div class="col-lg-6">
                <div class="label"><?php the_field('charthop_benefits_title', 'options'); ?></div>
                <h2><?php the_field('charthop_benefits_subtitle', 'options'); ?></h2>
                <?php the_field('charthop_benefits_content_link', 'options'); ?>
                <a href="<?php the_field('charthop_benefits_link', 'options'); ?>" class="button"><span>Book a demo</span></a>
            </div>
        </div>
    </div>
</section>