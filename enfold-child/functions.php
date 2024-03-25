<?php

/*
* Add your own functions here. You can also copy some of the theme functions into this file. 
* Wordpress will use those functions instead of the original functions then.
*/

require_once 'core/load.php'; 

//Disable html in wordpress comments

add_filter( 'pre_comment_content', 'wp_specialchars');

//Remove Query Strings from Static Resources

function _remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

/** Disable the emoji's */

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Remove WP embed script

function speed_stop_loading_wp_embed() {
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
	}
}
add_action('init', 'speed_stop_loading_wp_embed');


/* to support displaying custom post types */

add_theme_support('add_avia_builder_post_type_option');
add_theme_support('avia_template_builder_custom_post_type_grid');


function enfold_child_css_js() {

    wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/custom2.css?ver=' . date('now'), null, null);

}
add_action( 'wp_enqueue_scripts', 'enfold_child_css_js' );


add_action( 'gform_after_submission_2', 'post_to_third_party', 10, 2 );
function post_to_third_party( $entry, $form ) {
	//var_dump($entry[9]);
	$user_id = get_current_user_id();
	$mepr_photo_ex_www_domain_compic_jpg = $entry[9];
	$mepr_sponsor_id = $entry[11];
	$mepr_template = $entry[19];
	$mepr_custom_url_ex_ureoiljoy_comjohndoe = $entry[10];
	$mepr_biography = $entry[5];
	$mepr_fb_url = $entry[8];

	update_user_meta($user_id, 'mepr_photo_ex_www_domain_compic_jpg', $mepr_photo_ex_www_domain_compic_jpg);
	update_user_meta($user_id, 'mepr_sponsor_id', $mepr_sponsor_id);
	update_user_meta($user_id, 'mepr_template', $mepr_template);
	update_user_meta($user_id, 'mepr_custom_url_ex_ureoiljoy_comjohndoe', $mepr_custom_url_ex_ureoiljoy_comjohndoe);
	update_user_meta($user_id, 'mepr_biography', $mepr_biography);
	update_user_meta($user_id, 'mepr_fb_url', $mepr_fb_url);

	//$user_info = get_userdata($user_id);
	//var_dump($user_info);

	
}

add_action('wp_footer', 'add_custom_css_');
function add_custom_css_() {
	global $current_user;
	?>
	<script>
		var getUrlParameter = function getUrlParameter(sParam) {
		    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;

		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0] === sParam) {
		            return sParameterName[1] === undefined ? true : sParameterName[1];
		        }
		    }
		};

		jQuery(document).ready(function($) {

			$('#mepr-account-nav a').click(function(event) {
				var action = getUrlParameter('action');
				var hash = window.location.hash;
				// console.log(action);
				// console.log(hash);
				// console.log($(this).attr('href'));

				if( hash == '#account-settings--membership'){
					var href = $(this).attr('href');
					$(this).attr('href', href+hash);
				}				
			});

			$('.mepr-account-change-password a').click(function(event) {
				var action = getUrlParameter('action');
				var hash = window.location.hash;
				// console.log(action);
				// console.log(hash);
				// console.log($(this).attr('href'));

				if( hash == '#account-settings--membership'){
					var href = $(this).attr('href');
					$(this).attr('href', href+hash);
				}				
			});

		});
	</script>
	<style>
	#algolia-hits {
    padding: 0;
    padding-top: 0;
}
	.ais-hits {
		padding: 10px;
	}
	.instaseach_descript {
		font-size: 15px;
    line-height: 17px;
    margin-top: 8px;
	}
	.instaseach_pre_header {
		margin-top: 0;
		    font-weight: 600;
    font-size: 24px;
	}
	.instaseach_pre_header2 {
		font-weight: 600;
	}
	.instaseach_pre_header3 {
		font-style: italic;
	    font-size: 14px;
	    line-height: 17px;
	    display: inline-block;
	    padding-top: 6px;	
	}
	#ais-main {
		background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/img/Search_background.jpg");
	/*background-size: cover;*/
	background-size: 100% 159px;
    background-repeat: no-repeat;
    padding: 0;
    padding-top: 15px;
    background-position: 0px 13px;
	}
#search-bg {

}
#ais-wrapper {
    flex-direction: column;
}
#search-box-left {
	width: 50%;
    float: left;
        padding: 10px;
}
#search-box-right {
	width: 50%;
    float: left;
        padding: 10px;
}
/*.instaseach_pre {
	    display: flex;
    flex-direction: column;
    padding: 1rem;
}
.instaseach_pre_header {
	font-weight: 600;
}
.instaseach_pre_text:before {
	content: '';
}*/
@media only screen and (max-device-width: 800px) {
	#ais-main {
	    background-size: 100% 200px;
	}
	#search-box-left, #search-box-right {
		width: 100%;
    float: none;
	}
}
.avia-builder-el-56.custom-tool-section-img .avia-image-container-inner {
    margin-top: -10px;
    padding-top: 0;
}
.custum_section9_image1 img {
	bottom: -15px;
}
.custom_section10_image1 img {
	bottom: -39px;
}
.avia-builder-el-99 {
	padding-top: 0px;
}
.avia-builder-el-101 {
    margin-top: 2% !important;
}
#av_section_17 {
    margin-top: 0;
}
.avia-builder-el-125 {
	padding-left: 20px;
}
	</style>
	<?php
}