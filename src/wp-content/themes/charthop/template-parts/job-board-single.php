<?php
$job_id = $_GET['id'];
$job_data = getJobDataFromAPI($job_id);

$link = get_field('back_to_all_jobs', 'options');

// temporary integration with embed
if (false) :
    ?><div class="container ptop text_style">
        <div class="default_text singlejob">
            <h1><?php echo $job_data->title; ?></h1>
            <a href="<?php echo $link['url']; ?>" class="readmore back"><?php echo $link['title']; ?></a>
            <div class="pt104"></div><?php

            if (isset($job_data->content))
            {
                echo html_entity_decode($job_data->content);
            }

            ?>
            <a href="#" class="button"><span>Apply now</span></a>

        </div>
    </div><?php
endif;
?>
    <div class="singlejob_embed_form text-center"><?php
    
    
    
    ?>
    <iframe id="job_iframe" src="https://boards.greenhouse.io/embed/job_app?for=charthop&token=<?php echo $_GET['id']; ?>" frameborder="0"></iframe>
<!--    <img src="--><?php //echo IMG; ?><!--/embed_form.png" alt="">-->
</div>