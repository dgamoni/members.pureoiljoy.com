

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
                        get_template_part( 'includes/loop', 'video' );
                    
                    ?>

				<!--end content-->
				</main>

				<?php

					get_sidebar('video');

				?>

			</div><!--end container-->

		</div><!-- close default .container_wrap element -->