<?php
	
	global $post;

	echo "<article class='content-load-more ".implode(" ", get_post_class('post-entry post-entry-type-'.$post_format . " " . $post_class . " ".$with_slider))."' ".avia_markup_helper(array('context' => 'entry','echo'=>false)).">";

		echo '<div class="entry-content-wrapper clearfix video-content">';
			echo '<header class="entry-content-header">';
			    
				echo '<h2 class="post-title entry-title" itemprop="headline">';
					echo '<a href="'.get_the_permalink( $post->ID ).'" rel="bookmark" >'.$post->post_title.'</a>';
				echo '</h2>';

                echo "<div class='meta-video'><span class='post-meta-infos_'>";
	                echo "<time class='date-container minor-meta updated' >".get_the_time(get_option('date_format'))."</time>";
	                echo "<span class='text-sep text-sep-date'>/</span>";

	                if ( get_comments_number() != "0" || comments_open() ){

                    echo "<span class='comment-container minor-meta'>";
                    comments_popup_link(  "0 ".__('Comments','avia_framework'),
                                          "1 ".__('Comment' ,'avia_framework'),
                                          "% ".__('Comments','avia_framework'),'comments-link',
                                          "".__('Comments Disabled','avia_framework'));
                    echo "</span>";
                    echo "<span class='text-sep text-sep-comment'>/</span>";
                    }

                    echo '<span class="blog-author minor-meta">'.__('by','avia_framework')." ";
                    echo '<span class="entry-author-link" >';
                    echo '<span class="vcard author"><span class="fn">';
                    the_author_posts_link();
                    echo '</span></span>';
                    echo '</span>';
                    echo '</span>';
                echo '</span></div>';

			    get_template_part( 'includes/video'); 

			    $content = get_the_content( $post->ID );
			    $content_output = '';
			    if ($content):
			        $content_output .= '<span class="excerpt excerpt-'.$post->ID.'">'.get_the_content_limit(380).'</span>';
			        $content_output .= '<span class="whole-post whole-post-'.$post->ID.'">'.$content.'</span>';
			        $content_output .= '<a href="#" class="read read-'.$post->ID.'">[Read More]</a>';
			    endif;

			    echo '<div class="entry-content" itemprop="text">'.$content_output.'</div>';
			echo '</header>';
		echo '</div>';

	echo '</article>';

?>
	<script>
		jQuery(document).ready(function($) {

			$('a.read-<?php echo $post->ID; ?>').click(function (e) {
				e.preventDefault();
			    $(this).siblings('.whole-post-<?php echo $post->ID; ?>').is(':visible') ? $(this).html('[Read More]') : $(this).html('[Read Less]');
			     $(this).siblings('.excerpt-<?php echo $post->ID; ?>').slideToggle(100);
			     $(this).siblings('.whole-post-<?php echo $post->ID; ?>').slideToggle(100);
			});

		});
	</script> 