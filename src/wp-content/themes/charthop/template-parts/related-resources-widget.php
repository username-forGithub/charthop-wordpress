<?php
$enable_related_resources = false;

if (is_post_type_archive('integrations'))
{
    $enable_related_resources = get_field('enable_related_resources_widget', 'options');
    if ($enable_related_resources)
    {
        ?><section class="latest_blog singlestyle custom">
        <div class="container long">
            <div class="circle1"></div>
            <div class="circle2"></div><?php

            if (get_field('toope_related_resources'))
            {
                get_template_part('template-parts/related', 'resources', [
                    'resources'  =>  get_field('toope_related_resources', 'options')
                ]);
            }
            else
            {
                get_template_part('template-parts/related', 'resources');
            }

            ?></div>
        </section><?php
    }
}
else
{
    $enable_related_resources = get_field('enable_related_resources_widget');
    if ($enable_related_resources)
    {
        ?><section class="latest_blog singlestyle custom">
            <div class="container long">
                <div class="circle1"></div>
                <div class="circle2"></div><?php

                if (get_field('toope_related_resources'))
                {
                    get_template_part('template-parts/related', 'resources', [
                        'resources'  =>  get_field('toope_related_resources')
                    ]);
                }
                else
                {
                    get_template_part('template-parts/related', 'resources');
                }

            ?></div>
        </section><?php
    }

}

