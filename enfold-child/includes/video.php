<?php

global $post;

$embed_settings 	= cvm_get_video_settings( $post->ID, true );
$v = new CVM_Vimeo_Videos;
$video = $v->get_video_data($post->ID);
//var_dump($video);

$settings	= apply_filters('cvm_video_embed_settings', $embed_settings, $post, $video);
//var_dump($settings);

//var_dump( $video['video_id']);
$settings['video_id'] = $video['video_id'];

$video_data_atts = cvm_data_attributes( $settings );
//var_dump($video_data_atts);

$width 	= apply_filters( 'cvm-embed-width', $settings['width'], $video, 'automatic_embed' );
$width 	= apply_filters( 'cvm_embed_width', $width, $video, 'automatic_embed' );
$height = cvm_player_height( $settings['aspect_ratio'] , $width, $settings['size_ratio']);		
$plugin_embed_opt = cvm_get_player_settings();
//var_dump($plugin_embed_opt);

		$embed_html = '<!--video container-->';
		//if( isset( $plugin_embed_opt['js_embed'] ) && !$plugin_embed_opt['js_embed'] ){
			$params = array(
				'title'		=> $settings['title'],
				'byline'	=> $settings['byline'],
				'portrait'	=> $settings['portrait'],
				'loop'		=> $settings['loop'],
				'color'		=> $settings['color'],
				'fullscreen'=> $settings['fullscreen']
			);			
			$embed_url = 'https://player.vimeo.com/video/' . $video['video_id'] . '?' . http_build_query( $params, '', '&' ) ;			
			$extra_css .= ' cvm_simple_embed';
			$embed_html = '<iframe src="' . $embed_url . '" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		//}

$video_container = '<div class="cvm_single_video_player ' . $extra_css.'" ' . $video_data_atts . ' style="width:' . $width . 'px; height:' . $height . 'px; max-width:100%;">' . $embed_html . '</div>';

// add player script
cvm_enqueue_player();

echo $video_container;