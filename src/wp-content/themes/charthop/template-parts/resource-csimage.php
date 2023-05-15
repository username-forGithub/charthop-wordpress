<?php

if (isset($args['link']) && isset($args['title'])) :

    ?><div class="blog_box_image cust" style="background-color:<?php echo $args['color'] ?? '#000000'; ?>;">
        <a href="<?php echo $args['link']; ?>">
            <span class="cust_stor_logo">
                <img src="<?php echo $args['src']?: IMG . '/explore3.png'; ?>" alt="<?php echo $args['title']; ?>" data-no-retina>
            </span>
        </a>
    </div><?php

endif;