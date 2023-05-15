<?php 

/* 1. CONSTANTS */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'CSS', THEMEROOT . '/css' );
define( 'JS', THEMEROOT . '/js' );
define( 'IMG', THEMEROOT . '/img' );


function theme_scripts() { 
    wp_enqueue_style( 'main-css', CSS . '/main.css', null, null);
    wp_enqueue_style( 'theme-css', CSS . '/theme.css', null, null);
    wp_enqueue_style( 'extra-css', CSS . '/extra.css', null, null);
    wp_enqueue_style( 'hubspot-css', CSS . '/hubspot.css', null, null);

//    wp_enqueue_script( 'jquery-js', JS . '/jquery.min.js',null, null, false );
    wp_enqueue_script( 'main-js', JS . '/main.js', array("jquery"), null, true );
    wp_enqueue_script( 'theme-js', JS . '/theme.js', array("jquery"), null, true );
    wp_enqueue_script( 'extra-js', JS . '/extra.js', array("jquery"), null, true );

    wp_localize_script(
        "extra-js",
        "forms_obj",
        array(
            "ajax_url"      =>  admin_url("admin-ajax.php"),
            'security'      =>  wp_create_nonce('forms-security-nonce')
        )
    );
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

add_theme_support( 'menus' );
add_theme_support('post-thumbnails');

add_image_size('blog-post', 686, 366, ['center',  'center']);
add_image_size('blog-post-feature', 1135, 606, ['center',  'center']);
add_image_size('blog-single', 1248, 665, ['center',  'center']);
add_image_size('home-banner', 1180, 664, ['center',  'center']);
add_image_size('cs_single', 813, 433, ['center', 'center']);
add_image_size('video-single', 1135, 637, ['center',  'center']);
add_image_size('cs_mini', 39, 39, ['center',  'center']);
add_image_size('author', 75, 75, ['center',  'center']);


register_nav_menus(
    array(
        'footer_1' => 'Footer Menu Position #1',    
        'footer_2' => 'Footer Menu Position #2',  
        'footer_3' => 'Footer Menu Position #3',  
        'footer_4' => 'Footer Menu Position #4',  
        'topmenu' => 'Top Menu Location',    
    )
);

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('General'),
            'menu_title'  => __('General'),
            'redirect'    => false,
            
        ));

        // Add sub page.
        $child = acf_add_options_page(array(
            'page_title'  => __('Template parts'),
            'menu_title'  => __('Template parts'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add sub page.
        $child2 = acf_add_options_page(array(
            'page_title'  => __('HubSpot Forms'),
            'menu_title'  => __('HubSpot Forms'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }

    acf_add_options_page(array(
        'page_title'    => 'Platforms archive page',
        'menu_title'    => 'Platforms archive',
        'menu_slug'     => 'options_platforms',
        'capability'    => 'edit_posts',
        'parent_slug'   => 'edit.php?post_type=platform',
        'position'      => false,        
        'redirect'      => false,
    ));

    acf_add_options_page(array(
        'page_title'    => 'Solutions archive page',
        'menu_title'    => 'Solutions archive',
        'menu_slug'     => 'options_solutions',
        'capability'    => 'edit_posts',
        'parent_slug'   => 'edit.php?post_type=solutions',
        'position'      => false,        
        'redirect'      => false,
    ));

    acf_add_options_page(array(
        'page_title'    => 'Integrations archive page',
        'menu_title'    => 'Integrations archive',
        'menu_slug'     => 'options_integrations',
        'capability'    => 'edit_posts',
        'parent_slug'   => 'edit.php?post_type=integrations',
        'position'      => false,        
        'redirect'      => false,
    ));

    acf_add_options_page(array(
        'page_title'    => 'Jobs archive page',
        'menu_title'    => 'Jobs archive',
        'menu_slug'     => 'options_jobs',
        'capability'    => 'edit_posts',
        'parent_slug'   => 'edit.php?post_type=jobs',
        'position'      => false,        
        'redirect'      => false,
    ));

    acf_add_options_page(array(
        'page_title'    => 'Podcasts archive page',
        'menu_title'    => 'Podcasts archive',
        'menu_slug'     => 'options_podcasts',
        'capability'    => 'edit_posts',
        'parent_slug'   => 'edit.php?post_type=podcasts',
        'position'      => false,        
        'redirect'      => false,
    ));

    acf_add_options_page(array(
        'page_title'    => 'Press archive page',
        'menu_title'    => 'Press archive',
        'menu_slug'     => 'options_press',
        'capability'    => 'edit_posts',
        'parent_slug'   => 'edit.php',
        'position'      => false,        
        'redirect'      => false,
    ));  
}

// Change Post admin menu label
function collio_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Press';
    $submenu['edit.php'][5][0] = 'All Press';
    $submenu['edit.php'][10][0] = 'Add Press';
    $submenu['edit.php'][16][0] = 'Press Tags';
}
function collio_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Press';
    $labels->singular_name = 'Press';
    $labels->add_new = 'Add Press';
    $labels->add_new_item = 'Add Press';
    $labels->edit_item = 'Edit Press';
    $labels->new_item = 'Press';
    $labels->view_item = 'View Press';
    $labels->search_items = 'Search Press';
    $labels->not_found = 'No Press found';
    $labels->not_found_in_trash = 'No Press found in Trash';
    $labels->all_items = 'All Press';
    $labels->menu_name = 'Press';
    $labels->name_admin_bar = 'Press';
}
  
add_action( 'admin_menu', 'collio_change_post_label' );
add_action( 'init', 'collio_change_post_object' );

// short content
/**
* Filter the excerpt length to 20 words.
*
* @param int $length Excerpt length.
* @return int (Maybe) modified excerpt length.
*/
function wpdocs_custom_excerpt_length( $length ) {
    return 17;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/*
 * Ajax callback for pagination
 * */
// ajax callback for forms
if ( ! function_exists( 'forms_callback' ) ) {
    add_action( 'wp_ajax_forms_callback', 'forms_callback' );
    add_action( 'wp_ajax_nopriv_forms_callback', 'forms_callback' );
    function forms_callback(){

        if ( ! check_ajax_referer( 'forms-security-nonce', 'security' ) ) {
            wp_send_json_error( 'Invalid security token sent.' );
        } elseif ( isset($_POST['current_page']) ) {
            $form_response = array(
                'success'   =>  true,
                'posts'     => [],
                'filter_search' =>  $_POST['filter_search'],
                'filter_type'   =>  $_POST['filter_type'],
                'filter_cat'    =>  $_POST['filter_cat'],
                'has_next'      =>  false
            );


            $filter_search =  $_POST['filter_search'];
            $filter_type   =  $_POST['filter_type'];
            $filter_cat    =  $_POST['filter_cat'];

            $posts_per_page = get_option('posts_per_page');
            $offset = ((int) $_POST['current_page'] - 1) * $posts_per_page;
            $args = [
                'posts_per_page'    =>  999,
                'post_type'         =>  'resources',
//                'offset'            =>  $offset,
//                'limit'             =>  $posts_per_page
            ];

            // set search key
            if (! empty($filter_search))
            {
                $args['s'] = $filter_search;
            }

            // taxonomies
            $taxonomies = [
                'relation'  => 'AND'
            ];
            if (isset($_POST['extra_type'])) {
                if ($_POST['extra_type'] != 0)
                {

                    $taxonomies[] = [
                        'taxonomy' => 'content_type',
                        'field'    => 'term_id',
                        'terms'    => $_POST['extra_type'],
                    ];
                }
            }
            if (isset($_POST['extra_cat'])) {
                if ($_POST['extra_cat'] != 0)
                {

                    $taxonomies[] = [
                        'taxonomy' => 'resource_category',
                        'field'    => 'term_id',
                        'terms'    => $_POST['extra_cat'],
                    ];
                }
            }
            // set content type
            if (! empty($filter_type))
            {
                $taxonomies[] = [
                    'taxonomy' => 'content_type',
                    'field'    => 'slug',
                    'terms'    => [$filter_type],
                ];
            }

            // set category
            if (! empty($filter_cat))
            {
                $taxonomies[] = [
                    'taxonomy' => 'resource_category',
                    'field'    => 'slug',
                    'terms'    => $filter_cat,
                ];
            }

            if (count($taxonomies) > 1)
            {
                $args['tax_query'] = $taxonomies;
            }

            $posts = get_posts($args);
            // $form_response['args'] = $args;

            if (! empty($posts) && is_array($posts))
            {
                $content_types = get_terms('content_type', ['hide_empty' => false]);
                $content_links = [];
                if (is_array($content_types)) :

                    foreach ($content_types as $type)  :
                        $content_links[$type->term_id] = $type->name;
                    endforeach;

                endif;

                $categories = get_terms('resource_category', ['hide_empty' => false]);
                $category_links = [];
                if (is_array($categories)) :

                    foreach ($categories as $category)  :
                        $category_links[$category->term_id] = $category->name;
                    endforeach;

                endif;

                $isFeatured = false;

                foreach ($posts as $i => $post)
                {
                    if ($i < $offset)
                        continue;
                    if ($i == $posts_per_page + $offset)
                        break;

                    $types = wp_get_post_terms($post->ID, 'content_type', ['fields' => 'ids']);
                    //var_dump($types, $resource->ID);
                    $cats = wp_get_post_terms($post->ID, 'resource_category', ['fields' => 'ids']);
                    $post_data = [
                        'types' => [],
                        'cats'  => []
                    ];

                    // collect types
                    foreach ($types as $type)
                    {
                        $post_data['types'][] = [
                            'name'  =>  $content_links[$type],
                            'link'  =>  get_category_link($type),
                            'id'    =>  $type
                        ];
                        if ($type == 18) {
                            $isFeatured = true;
                        }
                    }

                    // collect cats
                    foreach ($cats as $cat)
                    {
                        $post_data['cats'][] = [
                            'name'  =>  $category_links[$cat],
                            'link'  =>  get_category_link($cat),
                            'id'    =>  $cat
                        ];
                    }

                    // collect post main data
                    $post_data['title'] =  $post->post_title;
                    $post_data['link'] =  get_permalink($post->ID);
                    if ($isFeatured)
                    {
                        $post_data['src'] =  get_the_post_thumbnail_url($post->ID, 'blog-post-feature');
                    }
                    else
                    {
                        $post_data['src'] =  get_the_post_thumbnail_url($post->ID, 'blog-post');
                    }
                    $post_data['excerpt'] =  get_the_excerpt($post->ID);

                    // customer story type has color property, cs type id is 15
                    if ( in_array(15, $cats) ) {
                        $post_data['color'] =  '#000000';
                    }



                    $form_response['posts'][] = $post_data;
                }
                $form_response['args'] = $args;
                $form_response['has_next'] = count($posts) > $posts_per_page + $offset;
//                $form_response['posts_count'] = count($posts);
                $form_response['total_pages'] = ceil(count($posts)/$posts_per_page);
            }
            else {
                echo json_encode(array(
                    'success'   => false,
                    'message'   => 'Sorry, nothing was found. Please try other options.'
                ));
                wp_die();
            }

            echo json_encode($form_response);
        } else {
            echo json_encode(array(
                'success'   => false,
                'message'   => 'Something went wrong. Please try other options.'
            ));
        }
        wp_die();
    }
}


// desc: rewrite URL
function tm_books_post_link( $post_link, $id = 0 ){
    $post = get_post($id);
    if (get_post_type($post) == 'resources')
    {
        $terms = wp_get_object_terms( $post->ID, 'content_type' );
        if( $terms ){
            $post_link = str_replace( '%content_type%' , $terms[0]->slug , $post_link );
        }


        $terms2 = wp_get_object_terms( $post->ID, 'resource_category' );
        if( $terms2 ){
            $post_link = str_replace( '%resource_category%' , $terms2[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'tm_books_post_link', 1, 3 );



/*
 *
 * GreenHouse Job Borad API
 */
if (! function_exists('isJobExists'))
{
    function isJobExists($job_id)
    {
        if (! $job_id)
            return false;
//        $api_key = get_field('jbs_api_key', 'options');
        $job_found = false;
        $token = get_field('jbs_board_token', 'options');
        $data_url = "https://boards-api.greenhouse.io/v1/boards/$token/jobs";

        $data = file_get_contents($data_url);
        $json_data = json_decode($data);

        if (isset($json_data->jobs))
        {
            if (is_array($json_data->jobs))
            {
                foreach ($json_data->jobs as $job)
                {
                    if ($job->id == $job_id)
                    {
                        $job_found = true;
                        break;
                    }
                }
            }
        }

        return $job_found;
    }
}

if (! function_exists('getJobsFromAPI'))
{
    function getJobsFromAPI()
    {
        $token = get_field('jbs_board_token', 'options');
        $data_url = "https://boards-api.greenhouse.io/v1/boards/$token/jobs";

        $data = file_get_contents($data_url);
        $json_data = json_decode($data);
        return $json_data->jobs ?? [];
    }
}
if (! function_exists('getJobDataFromAPI'))
{
    function getJobDataFromAPI($job_id)
    {
        if (! $job_id)
            return false;

        $token = get_field('jbs_board_token', 'options');
        $data_url = "https://boards-api.greenhouse.io/v1/boards/$token/jobs/$job_id";

        $data = file_get_contents($data_url);
        $json_data = json_decode($data);
        return $json_data ?? false;
    }
}

if (! function_exists('getDepartmentsFromAPI'))
{
    function getDepartmentsFromAPI()
    {
        $token = get_field('jbs_board_token', 'options');

        $data_url = "https://boards-api.greenhouse.io/v1/boards/$token/departments";
        $data = file_get_contents($data_url);
        $json_data = json_decode($data);

        return $json_data->departments ?? [];
    }
}

/*
 * WP Preview issue fix
 */
function fix_post_id_on_preview($null, $post_id) {
    if (is_preview() && $post_id !== 'options') {
        return get_the_ID();
    }
    else {
        $acf_post_id = isset($post_id->ID) ? $post_id->ID : $post_id;

        if (!empty($acf_post_id)) {
            return $acf_post_id;
        }
        else {
            return $null;
        }
    }
}

add_filter( 'acf/pre_load_post_id', 'fix_post_id_on_preview', 10, 2 );

if (! function_exists('isMobileDevice'))
{
    function isMobileDevice() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}