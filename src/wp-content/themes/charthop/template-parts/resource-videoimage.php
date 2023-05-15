<?php

if (isset($args['link']) && isset($args['src']) && isset($args['title'])) :

    ?><div class="blog_box_image video">
        <a href="<?php echo $args['link']; ?>">
            <span class="play">
                    <svg class="playicon" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" width="15.167" height="21"
                         viewBox="0 0 15.167 21">
                      <defs>
                        <clipPath id="clip-path">
                          <path id="Path_45" data-name="Path 45"
                                d="M23.333-38.5a1.167,1.167,0,0,1,.693.228l.032.025L36.8-28.984l0,0,.018.014a1.167,1.167,0,0,1,.517.968,1.167,1.167,0,0,1-.524.973l-12.783,9.3a1.167,1.167,0,0,1-.693.228,1.167,1.167,0,0,1-1.167-1.167V-37.333A1.167,1.167,0,0,1,23.333-38.5Z"
                                fill="#6e37ff" clip-rule="evenodd"/>
                        </clipPath>
                        <clipPath id="clip-path-2">
                          <path id="Path_44" data-name="Path 44"
                                d="M-757,1258H683V-5320H-757Z"/>
                        </clipPath>
                      </defs>
                      <g id="Group_144" data-name="Group 144"
                         transform="translate(-22.167 38.5)"
                         clip-path="url(#clip-path)">
                        <g id="Group_143" data-name="Group 143" clip-path="url(#clip-path-2)">
                          <path id="Path_43" data-name="Path 43"
                                d="M17.167-12.5H42.333v-31H17.167Z"/>
                        </g>
                      </g>
                    </svg>
            </span>
            <img src="<?php echo $args['src']?: IMG . '/explore3.png'; ?>" alt="<?php echo $args['title'] ?>" data-no-retina>
        </a>
    </div><?php

endif;