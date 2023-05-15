<section class="jobs_top">
    <div class="container ptop long">
        <h1><?php the_title(); ?></h1>
        <div class="jobs_top_txt"><?php
            the_content();
        ?></div>
    </div>
</section>

<!-- Greenhouse Job Board embedding -->
<?php

$all_jobs = getJobsFromAPI();
$all_departments = getDepartmentsFromAPI();

$html_code = ['', ''];

if (! empty($all_departments))
{
    foreach ($all_departments as $dep)
    {
        if (! empty($dep->jobs))
        {
            $html_code[0] .= '<li class="jobs-cat-class"><a class="target_c" data-uniqid="dep_'.$dep->id.'" href="javascript:;">'.$dep->name.'</a></li>';


            if (is_array($dep->jobs))
            {
                $html_code[1] .= '<div data-elheight="" class="dep_'.$dep->id.'"><h2>'.$dep->name.'</h2>';
                foreach ($dep->jobs as $job)
                {
//                    $html_code[1] .= '
//                        <a href="'.$job->absolute_url.'" class="jobs_line">
//                            <h3>'.$job->title.'</h3>
//                            <p>'.$job->location->name.'</p>
//                        </a>';
                    $html_code[1] .= '
                        <a href="?id='.$job->id.'" class="jobs_line">
                            <h3>'.$job->title.'</h3>
                            <p>'.$job->location->name.'</p>
                        </a>';
                }
                $html_code[1] .= '</div>';
            }
        }
    }
}

?>
<div class="container long jobs_body">
    <div class="row"><?php

        if (! empty($html_code[0])) :
            ?><div class="col-md-auto">
            <div class="job_sidebar">
                <div class="label">JUMP TO A JOB CATEGORY</div>
                <ul class="job_sidebar_categories"><?php
                    echo $html_code[0];
                    ?></ul>
                <div class="row justify-content-end show767 job_sidebar_nav">
                    <div class="col-auto">
                        <div class="sliderbtn prev slider_btn_prev"></div>
                    </div>
                    <div class="col-auto">
                        <div class="sliderbtn next slider_btn_next"></div>
                    </div>
                </div>
            </div>
            </div><?php
        endif;

        if (! empty($html_code[1])) :
            ?><div class="col-md">
            <div class="jobs_content job-listing">
                <div class="all_section_wrapper"><?php

                    echo $html_code[1];

                    ?></div>
            </div>
            </div><?php
        endif;
    ?></div>
</div><?php