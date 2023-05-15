<?php /*press archive */ ?>
<?php get_header(); ?>
       
<section class="blog_top blog_top--mini">
    <div class="container long press">
        <h1><?php the_field('press_title', 'options'); ?> </h1>
        <div class="blog_top_txt">
            <p><?php the_field('press_subtitle', 'options'); ?> </p>
            <small><?php the_field('press_enquiry', 'options'); ?> </small>
        </div>        
    </div>
</section> 

<div class="container long press_row">
    <div class="row grid52">

        <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                the_post();
        ?>   

                <div class="col-md-6 col-lg-4">
                    <div class="press_block">


                        <?php $extlink = get_field("ext_link") ;
                            if($extlink){
                        ?>

                            <a target="_blunk" href="<?php echo $extlink;?>" class="press_block_image">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" data-no-retina>
                            </a>
                            <h3>
                                <a target="_blunk" href="<?php echo $extlink; ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php the_excerpt();?>

                        <?php } else { ?>
                            <a href="<?php the_permalink(); ?>" class="press_block_image">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" data-no-retina>
                            </a>
                            <h3>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php the_excerpt();?>

                        <?php } ?>




                    </div>
                </div> 

        <?php    
                } wp_reset_postdata();
            } 
        ?>         
            
    </div>
</div>




<section class="stories_carousel_sec press">
    <div class="container long">
        <div class="row">
            <div class="col-lg-6">
                <div class="label"><?php the_field('podcasts_title', 'options'); ?></div>
                <h2><?php the_field('podcasts_subtitle', 'options'); ?></h2>
            </div>
        </div>
          
        <div class="stories_carousel_holder">
            <div class="stories_carousel">

                <?php
                $custom_args = array(
                    'post_type' => 'podcasts',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',               
                );
                $custom_query = new WP_Query( $custom_args ); 
                ?>
                <?php if ( $custom_query->have_posts() ) : ?>
                    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

                        <div class="item">
                            <ul class="blog_tags row no-gutters">                           	
                                <?php echo get_the_term_list( $post->ID, 'podcast', '<li class="col-auto">', '</li>' ); ?>    
                            </ul>
                            <div class="carousel_box">
                                <div class="row grid52 align-items-center podcast_top">
                                    <div class="col-sm-auto">
                                        <div class="podcast_top_image">
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" data-no-retina>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="row carousel_box_author align-items-center no-gutters">
                                            <div class="col-auto">
                                                <img src="<?php the_field("author_image"); ?>" alt="" data-no-retina>
                                            </div>
                                            <div class="col">
                                                <h4>BY <?php the_field('author_full_name'); ?> </h4>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <h3>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                                </h3>
                                <?php the_excerpt(); ?>

                                <?php 
                                $getlink = get_field('link');
                                if( $getlink ): 
                                    $link_url = $getlink['url'];
                                    $link_title = $getlink['title'];                       
                                    ($getlink['target']) ? $link_target = $getlink['target'] : $link_target ="";                                              
                                ?>                     
                          
                                <a href="<?php echo $link_url; ?>" class="podcast_play" target="<?php echo esc_attr( $link_target ); ?>">
                                    <span class="play">
                                        <svg class="playicon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15.167" height="21" viewBox="0 0 15.167 21">
                                            <defs>
                                            <clipPath id="clip-path">
                                                <path id="Path_45" data-name="Path 45" d="M23.333-38.5a1.167,1.167,0,0,1,.693.228l.032.025L36.8-28.984l0,0,.018.014a1.167,1.167,0,0,1,.517.968,1.167,1.167,0,0,1-.524.973l-12.783,9.3a1.167,1.167,0,0,1-.693.228,1.167,1.167,0,0,1-1.167-1.167V-37.333A1.167,1.167,0,0,1,23.333-38.5Z" fill="#6e37ff" clip-rule="evenodd"/>
                                            </clipPath>
                                            <clipPath id="clip-path-2">
                                                <path id="Path_44" data-name="Path 44" d="M-757,1258H683V-5320H-757Z"/>
                                            </clipPath>
                                            </defs>
                                            <g id="Group_144" data-name="Group 144" transform="translate(-22.167 38.5)" clip-path="url(#clip-path)">
                                            <g id="Group_143" data-name="Group 143" clip-path="url(#clip-path-2)">
                                                <path id="Path_43" data-name="Path 43" d="M17.167-12.5H42.333v-31H17.167Z"/>
                                            </g>
                                            </g>
                                        </svg> 
                                    </span>
                                    <?php echo $link_title; ?>
                                </a>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; wp_reset_query();?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/logos', 'trusted', ["hide" => true]); ?>
<?php get_template_part('template-parts/demo', 'form'); ?>

<?php get_footer();?>