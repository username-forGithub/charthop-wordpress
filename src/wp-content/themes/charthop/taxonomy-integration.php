<?php get_header(); ?>
    <div class="container long press_row integ ">
        <div class="row grid52">
            <div class="col-12 category-page">
                <div class="press_row_h3">
                    <h3><?php the_field('integration_title', 'options'); ?> </h3>
                </div>
            </div>

            <?php 


                $obj = get_queried_object();

                $custom_args = array(
                    'post_type' => 'integrations',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array (
                            'taxonomy' => 'integration',
                            'field' => 'slug',
                            'terms' => $obj->slug,
                        )
                    ),
                );
                $custom_query = new WP_Query( $custom_args ); 
                ?>
                <?php if ( $custom_query->have_posts() ) : ?>
                    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>


                    <div class="col-md-6 col-lg-4">
                        <div class="press_block">
                            <a href="<?php the_permalink(); ?>" class="press_block_image">
                            <img src="<?php the_post_thumbnail_url(); ?> " alt="" data-no-retina>
                            </a>
                            <h3>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php
                            the_excerpt();
                            // $excerpt = get_field("sub_image_content_text");
                            // $excerpt = substr( $excerpt, 0, 105 );
                            // echo $excerpt . "...";  
                            ?>
        
                        </div>
                    </div>  
                    <?php endwhile; ?>
                <?php endif; wp_reset_query();?>       
        </div>
    </div> 
<?php
get_template_part('template-parts/demo', 'form');

get_footer(); ?>