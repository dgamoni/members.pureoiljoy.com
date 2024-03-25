<?php

add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar(array(
		'name' => 'Custom Right Sidebar',
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">', 
		'after_widget' => '<span class="seperator extralight-border"></span></section>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		'id'=>'av_blog_custom'
	));
}

add_action('wp_footer', 'add_custom_css');
function add_custom_css() {
	global $current_user;
	?>
	<script>
		jQuery(document).ready(function($) {

		});
	</script>
	<style>

	/*shop*/
	#top .thumbnail_container img {
	    width: auto;
	}
	.thumbnail_container {
	    display: flex;
	    flex-flow: column wrap;
	    align-items: center;
	    justify-content: center;
	    height: 300px;
	    background-color: white;
	}

	</style>
	<?php
} 