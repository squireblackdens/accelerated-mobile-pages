<?php 
/*
	@data parameter have options for
	show_excerpt
*/
function ampforwp_framework_get_related_posts($argsdata=array()){
 	global $post,  $redux_builder_amp;
 	$show_image = (isset($argsdata['show_image']) ? $argsdata['show_image'] : true);
	$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-related-posts'];
	$int_number_of_related_posts = round(abs(floatval($string_number_of_related_posts)));
	$my_query = related_post_loop_query();
	if ( isset($redux_builder_amp['ampforwp-single-related-posts-switch']) && $redux_builder_amp['ampforwp-single-related-posts-switch'] ) {
		if( $my_query->have_posts() ) { ?>
			<div class="amp-related-posts">
				<ul class="clearfix">
					<?php ampforwp_related_post(); ?>
					<?php
				    while( $my_query->have_posts() ) {
					    $my_query->the_post();
					    
					?>
						<li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
				            <?php
				            $related_post_permalink = ampforwp_url_controller( get_permalink() );
				            if ( $show_image ) {
					            if ( isset($argsdata['image_size']) && '' != $argsdata['image_size'] ) {
					            	ampforwp_get_relatedpost_image($argsdata['image_size']);
					            }
					            else {
					            	ampforwp_get_relatedpost_image('thumbnail');
					            }
					        }
				            ampforwp_get_relatedpost_content($argsdata);
				            ?> 
				        </li><?php
					}

				} ?>
				</ul>
			</div>
	<?php wp_reset_postdata(); ?>
	<?php do_action('ampforwp_below_related_post_hook');
	} 
}

function yarpp_post_loop_query($reference_ID = null, $args = array()){
		global $yarpp,$redux_builder_amp;
		$posts = $yarpp->get_related( null, array());
		if(!$posts){
			return ;
		}
		foreach ($posts as $key => $value) {
			$postsIds[] = $value->ID;
		}
		$args = array(
		    'post__in' => $postsIds
		);
		$posts = new WP_Query($args);
		return $posts;	
}

function related_post_loop_query(){
	global $post,  $redux_builder_amp;
	$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-related-posts'];
	$int_number_of_related_posts = round(abs(floatval($string_number_of_related_posts)));
	$args = null;
	$orderby = 'ID';
	    if( isset( $redux_builder_amp['ampforwp-single-order-of-related-posts'] ) && $redux_builder_amp['ampforwp-single-order-of-related-posts'] ){
				$orderby = 'rand';
			}
	if($redux_builder_amp['ampforwp-single-select-type-of-related']==2){
	    $categories = get_the_category($post->ID);
		if ($categories) {
				$category_ids = array();
				foreach($categories as $individual_category){ $category_ids[] = $individual_category->term_id;
				}
				$args=array(
				    'category__in' => $category_ids,
				    'post__not_in' => array($post->ID),
				    'posts_per_page'=> $int_number_of_related_posts,
				    'orderby' => $orderby,
				    'ignore_sticky_posts'=>1,
						'has_password' => false ,
						'post_status'=> 'publish'
				);
		}
	} 
    // tags
	if($redux_builder_amp['ampforwp-single-select-type-of-related']==1) {
		$ampforwp_tags = get_the_tags($post->ID);
		if ($ampforwp_tags) {
						$tag_ids = array();
						foreach($ampforwp_tags as $individual_tag) {
							$tag_ids[] = $individual_tag->term_id;
						}
						$args=array(
						   'tag__in' => $tag_ids,
						    'post__not_in' => array($post->ID),
						    'posts_per_page'=> $int_number_of_related_posts,
						    'orderby' => $orderby,
						    'ignore_sticky_posts'=>1,
								'has_password' => false ,
								'post_status'=> 'publish'
						);

		}
	}
	// Related Posts Based on Past few Days #2132
	if ( isset($redux_builder_amp['ampforwp-related-posts-days-switch']) && true == $redux_builder_amp['ampforwp-related-posts-days-switch'] ) {
		$date_range = strtotime ( '-' . $redux_builder_amp['ampforwp-related-posts-days-text'] .' day' );
		$args['date_query'] = array(
					            array(
					                'after' => array(
					                    'year'  => date('Y', $date_range ),
					                    'month' => date('m', $date_range ),
					                    'day'   => date('d', $date_range ),
					                	),
					            	)
					       		); 
	}
	$my_query = new wp_query( $args );

	if( is_plugin_active( 'yet-another-related-posts-plugin/yarpp.php' )){
		$yarpp_query = yarpp_post_loop_query();
		if( $yarpp_query ){
			$my_query = $yarpp_query;
		}
	}

	return $my_query;
}

function ampforwp_related_post(){ 
	global $redux_builder_amp;
	do_action('ampforwp_above_related_post'); //Above Related Posts
	?>
   <h3 class="amp-related-posts-title"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-related-text'], 'Related Post' ); ?></h3>
<?php } 

function ampforwp_get_relatedpost_image( $imagetype ='thumbnail', $data=array() ){
	global $redux_builder_amp;
	$related_post_permalink = ampforwp_url_controller( get_permalink() );
	if ( isset($redux_builder_amp['ampforwp-single-related-posts-link']) && true == $redux_builder_amp['ampforwp-single-related-posts-link'] ) {
		$related_post_permalink = get_permalink();
	}
	$show_image = (isset($data['show_image']) ? $data['show_image'] : true);
	?>
	<a href="<?php echo esc_url( $related_post_permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
	    <?php
	    if (ampforwp_has_post_thumbnail()  ) {
	    	$thumb_url = ampforwp_get_post_thumbnail('url', $imagetype);
			$thumb_width = ampforwp_get_post_thumbnail('width', $imagetype);
			$thumb_height = ampforwp_get_post_thumbnail('height', $imagetype);
	        if(isset($data['image_crop']) && $data['image_crop'] != ""){
				$width 	= $data['image_crop_width'];
				if(empty($width)){
					$width = $thumb_url_array_2[1];
				}
				$height = $data['image_crop_height'];
				if(empty($height)){
					$height = $thumb_url_array_2[2];
				}
				if ( isset($redux_builder_amp['ampforwp-retina-images']) && true == $redux_builder_amp['ampforwp-retina-images'] ) {
					$resolution = 2;
					if ( isset($redux_builder_amp['ampforwp-retina-images-res']) && $redux_builder_amp['ampforwp-retina-images-res'] ) {
						$resolution = $redux_builder_amp['ampforwp-retina-images-res'];
					}
					$width 	= $width * $resolution;
					$height = $height * $resolution;
				}
				$thumb_url_array = ampforwp_aq_resize( $thumb_url, $width, $height, true, false, true ); //resize & crop the image
				$thumb_url = $thumb_url_array[0];
				$thumb_width = $thumb_url_array[1];
				$thumb_height = $thumb_url_array[2];
			}
	    
	     if ( $thumb_url && $show_image ) { ?>
	    	<amp-img src="<?php echo esc_url( $thumb_url ); ?>" width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>" layout="responsive"></amp-img>
		<?php }
		} ?>
    </a>
<?php
}

function ampforwp_get_relatedpost_content($argsdata=array()){
	global $redux_builder_amp;
	$related_post_permalink = ampforwp_url_controller( get_permalink() );
	if ( isset($redux_builder_amp['ampforwp-single-related-posts-link']) && true == $redux_builder_amp['ampforwp-single-related-posts-link'] ) {
		$related_post_permalink = get_permalink();
	}
	?>
	<div class="related_link">
        <a href="<?php echo esc_url( $related_post_permalink ); ?>"><?php the_title(); ?></a>
        <?php
        $show_excerpt = (isset($argsdata['show_excerpt'])? $argsdata['show_excerpt'] : true);
        if($show_excerpt){
             if(has_excerpt()){
					$content = get_the_excerpt();
				}else{
					$content = get_the_content();
				}
		?><p><?php 
		echo wp_trim_words( strip_shortcodes( $content ) , '15' ); 
		?></p><?php 
		} 
		$show_author = (isset($argsdata['show_author'])? $argsdata['show_author'] : true);
		if($show_author){
			$author_args = isset($argsdata['author_args'])? $argsdata['author_args'] : array();
			ampforwp_framework_get_author_box($author_args);
		} ?>
	</div>
<?php }