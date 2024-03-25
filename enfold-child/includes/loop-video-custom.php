<?php

if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part( 'includes/loop', 'video-custom-content');
    endwhile;
endif;