<?php
if (! empty(get_field('tpoc_form_shortcode', 'options'))) :
    ?><div class="newsletterbox">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"><?php

                    the_field('tpoc_content', 'options')

                ?></div>
                <div class="col-lg-6">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm"><?php
                            the_field('tpoc_form_shortcode', 'options');
                        ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php
endif;