<div class="amp-wp-article-content">

	<!--Post Content here-->
	<div class="amp-wp-content the_content">
		<?php amp_content(); ?>
	</div>
	<!--Post Content Ends here-->

	<!--Post Next-Previous Links-->
	<?php global $redux_builder_amp;
		if($redux_builder_amp['enable-single-next-prev'] && !is_page() ) { ?>
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">
                <?php $next_post = get_next_post();
                    if (!empty( $next_post )) {
                    if(false == ampforwp_get_setting('single-next-prev-to-nonamp')){
                    ?>
                    <span><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-next-read-text'], 'Next Read' ); ?></span> <a href="<?php echo 
                    ampforwp_url_controller( get_permalink( $next_post->ID ) ); ?>"><?php echo $next_post->post_title; ?> &raquo;</a> <?php
                	} else{ ?>
					<span><?php echo ampforwp_translation(ampforwp_get_setting('amp-translator-next-read-text'), 'Next Read' ); ?></span> <a href="<?php echo 
                     get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?> &raquo;</a>

                  <?php } } ?>
				</div>
			</div>
		<?php } ?>
	<!--Post Next-Previous Links End here-->

</div>