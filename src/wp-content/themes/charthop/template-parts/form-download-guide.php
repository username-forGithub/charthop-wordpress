<?php


if (isset($args['special_form']))
{
    if (get_field('eif_form_title', 'options'))
    {
        echo '<h3>';
        if (isset($args['special_title']))
        {
            if (! empty($args['special_title']))
            {
                echo $args['special_title'];
            }
            else
            {
                the_field('eif_form_title', 'options');
            }
        }
        else
        {
            the_field('eif_form_title', 'options');
        }
        echo '</h3>';
    }
    ?><div class="guide-class"><?php


    echo $args['special_form'];


    ?></div><?php
    if (get_field('eif_form_text', 'options'))
    {
        echo '<small>';
        the_field('eif_form_text', 'options');
        echo '</small>';
    }

}
//else if (get_field('fsh_ebooks_in_resources', 'options'))
//{
//    echo get_field('fsh_ebooks_in_resources', 'options');
//}

