<?php global $post;	?>
	<script>
		jQuery(document).ready(function($) {

			$('a.read-<?php echo $post->ID; ?>').click(function (e) {
				e.preventDefault();
			    $(this).siblings('.whole-post-<?php echo $post->ID; ?>').is(':visible') ? $(this).html('[Read More]') : $(this).html('[Read Less]');
			     $(this).siblings('.excerpt-<?php echo $post->ID; ?>').fadeToggle(100);
			     $(this).siblings('.whole-post-<?php echo $post->ID; ?>').fadeToggle(100);
			});

		});
	</script> 