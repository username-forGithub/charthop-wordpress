<?php

if (isset($args['link']) && isset($args['title'])) :
    
    ?><div class="blog_box_image">
        <a href="<?php echo $args['link']; ?>">
            <img src="<?php echo $args['src']?: IMG . '/explore3.png'; ?>" alt="<?php echo $args['title']; ?>" data-no-retina>
        </a>
    </div><?php

endif;