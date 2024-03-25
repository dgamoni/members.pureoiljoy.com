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
		// jQuery(document).ready(function($) {

		// 	$('a.read').click(function (e) {
		// 		e.preventDefault();
		// 	    $(this).siblings('.whole-post').is(':visible') ? $(this).html('[Read More]') : $(this).html('[Read Less]');
		// 	     $(this).siblings('.excerpt').fadeToggle(100);
		// 	     $(this).siblings('.whole-post').fadeToggle(500);
		// 	});

		// });
	</script>
	<style>
	.aja_search_wrapper {
		padding-top: 40px;
	}
	#load-more {
		/*display: none;*/
	}
	.post-type-archive-vimeo-video .entry-content,
	.tax-vimeo-videos .entry-content {
		margin-right: 30px;
		margin-top: 10px;
	}
	.post-type-archive-vimeo-video .sidebar,
	.tax-vimeo-videos .sidebar,
	.single-vimeo-video .sidebar {
		padding-top: 50px !important;
	}
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
	.read {
		display: block;
		text-align: center;
		text-transform: uppercase;
	}
	.whole-post {
	  display: none;
	}
	.content-load-more.post-entry {
		margin-bottom: 30px;
	}
	.html_elegant-blog #top .content-load-more.post-entry .post-title {
		padding-bottom: 0;
	    margin-bottom: 0;
	}
	.meta-video {
		margin-bottom: 20px;
	}
/*	.read-more a {
		color: black;
	}*/

	</style>
	<?php
} 

function get_the_content_limit($max_char, $more_link_text = '[READ MORE]', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('get_the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
  	$content = strip_tags($content);

 	if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        //$content = substr($content, 0, $espacio);
        $sub_content = iconv_substr( $content, 0, $espacio, 'utf-8' );
        $content = $sub_content.'...';

    } else {
      //echo $content;
   }
   return $content;
}

