

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

			<div class='container template-blog '>

				<main class='content av-content-small alpha units'>
					
					<?php 
						
						$tds =  term_description(); 
						if($tds)
						{
							echo "<div class='category-term-description'>{$tds}</div>";
						}

                        $more = 0;
                        
                       
                    		get_template_part( 'includes/loop', 'video-custom' );
                        
                        // echo '<div id="video-load-more">';
                        // echo '</div>';
                        //get_template_part( 'includes/loop', 'video' );

//[ajax_load_more container_type="div" css_classes=".content-load-more" post_type="post" scroll_distance="1500" scroll_container=".content-load-more" transition_container_classes="undefined"]
//[ajax_load_more container_type="div" css_classes=".content-load-more" post_type="post" taxonomy="vimeo-videos" taxonomy_terms="farms" taxonomy_operator="IN" scroll_distance="1500" scroll_container=".content-load-more" transition_container_classes="undefined"]
                    		$cat = '';
                    		if(is_tax()):
                    			//var_dump(get_queried_object()->slug);
                    			$cat = 'taxonomy="vimeo-videos" taxonomy_terms="'.get_queried_object()->slug.'" taxonomy_operator="IN"';
                    		else:
                    			$cat = '';
                    		endif;

                    	echo do_shortcode('[ajax_load_more post_type="vimeo-video" '.$cat.'container_type="div" css_classes=".content-load-more"   offset="5" posts_per_page="1" ]');
                    ?>

				<!--end content-->
				</main>

				<?php

					get_sidebar('video');

				?>

			</div><!--end container-->

		</div><!-- close default .container_wrap element -->