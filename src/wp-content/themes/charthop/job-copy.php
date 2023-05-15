<?php get_header(); ?>


 <section class="jobs_top">
    <div class="container ptop long">
        <h1>Current Job Openings</h1>
        <div class="jobs_top_txt">
            <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
        </div>
    </div>
</section>

<div class="container long jobs_body">
    <div class="row">
        <div class="col-md-auto">
            <div class="job_sidebar">
                <div class="label">JUMP TO A JOB CATEGORY</div>
                <ul class="job_sidebar_categories">

                    <?php
                    $args = array(
                        'post_type' => 'jobs',
                        'taxonomy'  => 'job'
                      );
                      $terms = get_terms( $args );

                      foreach($terms as $term){ ;?>
                        <li><a><?php echo $term->name; ?></a></li>

                      <?php } ; ?>

                </ul>
                <div class="row justify-content-end show767 job_sidebar_nav">
                    <div class="col-auto">
                    <div class="sliderbtn prev slider_btn_prev"></div>
                    </div>
                    <div class="col-auto">                            
                    <div class="sliderbtn next slider_btn_next"></div>              
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="jobs_content">        
                <?php
               
//                if ( have_posts() ) :
//                    while ( have_posts() ) : the_post();
                        ?>                       
                        <a href="#" class="jobs_line">
                            <h3><?php the_title(); ?></h3>                            
                        </a> 
                        
                        <div class="aaa">
                            <?php
                            $all_data = [];
                            $dd = get_terms('job');                            
                            foreach($dd as $d){                               
                                $all_data[$d->name] = [];
                                    $cat_posts = get_posts([
                                        'post_type' => 'jobs',
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'job',
                                                'field'    =>  'slug',
                                                'terms'    => [$d->slug]
                                            ]
                                        ]
                                    ]);
                                    foreach ($cat_posts as $post)
                                    {
                                        $all_data[$d->name][$post->post_title] = $post->ID;
                                    }
                            }

                            echo '<pre>';
                            var_dump($all_data);
                            echo '</pre>';

                          ?>                     
    
                        </div>                        
                        
                        <?php 
//                    endwhile;
//                    wp_reset_postdata();
//                    endif; ?>
            </div>
        </div>
    </div>
</div>
<hr>
<?php 

// foreach($mainArray as $mark => $ff) {
     
//          echo $mark;
//          print_r($ff) ;
    
// }


?>
<hr>
<?php
  $marks = array( 
      "Ankit" => array(
          "C" => 95,
          "DCO" => 85,
          "FOL" => 74,
      ),
      "Ram" => array(
          "C" => 78,         
          "FOL" => 46,
      ),
      "Anoop" => array(
          "C" => 88,
          "DCO" => 46,
          "FOL" => 99,
      ),
  ); 
//   print_r(array_keys($marks));     
  // Accessing array elements using for each loop
//   foreach($marks as $mark => $ff) {
     
//       echo $mark ."<br>";
//       print_r($ff) ;
//       echo "<br>";

//   }

?>

<?php 
 get_footer(); ?>