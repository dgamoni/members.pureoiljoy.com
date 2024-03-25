<?php
if ( !defined('ABSPATH') ){ die(); }

global $avia_config;

// $sidebar = 'right';
// $sidebar = apply_filters('avf_sidebar_position', $sidebar);   


echo "<aside class='sidebar sidebar_right  alpha units' ".avia_markup_helper(array('context' => 'sidebar', 'echo' => false)).">";
    echo "<div class='inner_sidebar extralight-border'>";

        dynamic_sidebar('av_blog_custom');

    echo "</div>";
echo "</aside>";






