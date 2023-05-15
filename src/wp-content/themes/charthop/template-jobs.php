<?php
/*
 * Template Name: Jobs
 */
get_header('job');

if (isset($_GET['id']))
{
    // job single
    get_template_part('template-parts/job', 'board-single');
}
else
{
    // job board archive
    get_template_part('template-parts/job', 'board-archive');
}

get_footer();