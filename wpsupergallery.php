<?php
/*
Plugin Name: WP Super Gallery
Plugin URI: http://www.wpstatslive.info/wp-super-gallery/
Description: A image gallery plugin for WordPress. 
Author: Sam cunningham
Author URI: http://www.wpstatslive.info
Version: 3.0.3
*/


if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { 
	die('Illegal Entry');  
}

//============================== WP Super Gallery options ========================//
class super_plugin_options {

	function PS_getOptions() {
		$options = get_option('ps_options');
		
		if (!is_array($options)) {
			
			$options['use_paging'] = false;
			
			$options['enable_history'] = false;
			
			$options['num_thumb'] = '9';
			
			$options['use_hover'] = false;
			
			$options['show_captions'] = false;
			
			$options['show_download'] = false;
			
			$options['show_controls'] = false;
			
			$options['show_bg'] = false;
			
			$options['auto_play'] = false;			
			$options['delay'] = 3500;
			
			$options['button_size'] = 50;
			
			$options['hide_thumbs'] = false;
			
			$options['reset_css'] = false;
			
			$options['thumbnail_margin'] = 10;
			
			$options['thumbnail_width'] = 50;
			$options['thumbnail_height'] = 50;
			$options['thumbnail_crop'] = true;	
			
			$options['thumb_col_width'] = '181';	
			$options['main_col_width'] = '400';
			$options['main_col_height'] = '500';
			$options['gallery_width'] = '600';
			
			$options['play_text'] = 'Play Slideshow';
			$options['pause_text'] = 'Pause Slideshow';
			$options['previous_text'] = '&lsaquo; Previous Photo';
			$options['next_text'] = 'Next Photo &rsaquo;';
			$options['download_text'] = 'Download Original';	
						
			
			update_option('ps_options', $options);
		}
		return $options;
	}

	function update() {
		if(isset($_POST['ps_save'])) {
			$options = super_plugin_options::PS_getOptions();
			
			$options['num_thumb'] = stripslashes($_POST['num_thumb']);
			$options['thumbnail_margin'] =  stripslashes($_POST['thumbnail_margin']);
			$options['thumbnail_width'] = stripslashes($_POST['thumbnail_width']);
			$options['thumbnail_height'] = stripslashes($_POST['thumbnail_height']);			
			
			
			$options['thumb_col_width'] = stripslashes($_POST['thumb_col_width']);
			$options['main_col_width'] = stripslashes($_POST['main_col_width']);
			$options['main_col_height'] = stripslashes($_POST['main_col_height']);
			
			$options['gallery_width'] = stripslashes($_POST['gallery_width']);
			
			$options['delay'] = stripslashes($_POST['delay']);
			
			$options['button_size'] = stripslashes($_POST['button_size']);

			if ($_POST['enable_history']) {
				$options['enable_history'] = (bool)true;
			} else {
				$options['enable_history'] = (bool)false;
			} 
			
			if ($_POST['use_paging']) {
				$options['use_paging'] = (bool)true;
			} else {
				$options['use_paging'] = (bool)false;
			} 
			
			if ($_POST['thumbnail_crop']) {
				$options['thumbnail_crop'] = (bool)true;
			} else {
				$options['thumbnail_crop'] = (bool)false;
			} 
			
			if ($_POST['show_controls']) {
				$options['show_controls'] = (bool)true;
			} else {
				$options['show_controls'] = (bool)false;
			} 
			
			if ($_POST['show_download']) {
				$options['show_download'] = (bool)true;
			} else {
				$options['show_download'] = (bool)false;
			} 
			
			if ($_POST['show_captions']) {
				$options['show_captions'] = (bool)true;
			} else {
				$options['show_captions'] = (bool)false;
			}
			
			if ($_POST['show_bg']) {
				$options['show_bg'] = (bool)true;
			} else {
				$options['show_bg'] = (bool)false;
			} 
					
			if ($_POST['use_hover']) {
				$options['use_hover'] = (bool)true;
			} else {
				$options['use_hover'] = (bool)false;
			}
			
			if ($_POST['auto_play']) {
				$options['auto_play'] = (bool)true;
			} else {
				$options['auto_play'] = (bool)false;
			}
			
			if ($_POST['hide_thumbs']) {
				$options['hide_thumbs'] = (bool)true;
			} else {
				$options['hide_thumbs'] = (bool)false;
			}
			
			if ($_POST['reset_css']) {
				$options['reset_css'] = (bool)true;
			} else {
				$options['reset_css'] = (bool)false;
			}
			
			$options['play_text'] = stripslashes($_POST['play_text']);
			$options['pause_text'] = stripslashes($_POST['pause_text']);
			$options['previous_text'] = stripslashes($_POST['previous_text']);
			$options['next_text'] = stripslashes($_POST['next_text']);
			$options['download_text'] = stripslashes($_POST['download_text']);
			
			update_option('ps_options', $options);

		} else {
			super_plugin_options::PS_getOptions();
		}

		add_menu_page('WP Super Gallery options', 'WP Super Gallery Options', 'edit_themes', basename(__FILE__), array('super_plugin_options', 'display'));
	}
	

	function display() {
		
		$options = super_plugin_options::PS_getOptions();
		?>
		
		<div class="wrap">
		
			<h2>WP Super Gallery Options</h2>
			
			<form method="post" action="#" enctype="multipart/form-data">				

				<!-- Too buggy			
				<h3>Change photo on hover?</h3>
				<p><input name="use_hover" type="checkbox" value="checkbox" <?php if($options['use_hover']) echo "checked='checked'"; ?> /> Yes </p>
				<br />-->
				
				<div class="wp-menu-separator" style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>
				
				<h3><label><input name="show_download" type="checkbox" value="checkbox" <?php if($options['show_download']) echo "checked='checked'"; ?> /> Show download link</label></h3>			
				
				<h3><label><input name="show_controls" type="checkbox" value="checkbox" <?php if($options['show_controls']) echo "checked='checked'"; ?> /> Show controls (play slide show / Next Prev image links)</label></h3>			
				
				<h3><label><input name="use_paging" type="checkbox" value="checkbox" <?php if($options['use_paging']) echo "checked='checked'"; ?> /> Use paging </label></h3>			
				
				<h3><label><input name="enable_history" type="checkbox" value="checkbox" <?php if($options['enable_history']) echo "checked='checked'"; ?> /> Enable history </label></h3>			
				
				
				<h3><label><input name="show_captions" type="checkbox" value="checkbox" <?php if($options['show_captions']) echo "checked='checked'"; ?> /> Show Title / Caption / Desc under image</label></h3>
				
				<h3><label><input name="reset_css" type="checkbox" value="checkbox" <?php if($options['reset_css']) echo "checked='checked'"; ?> /> Try to clear current theme image css / formatting</label></h3>


				<h3><label><input name="show_bg" type="checkbox" value="checkbox" <?php if($options['show_bg']) echo "checked='checked'"; ?> /> Show background colours for layout testing</label></h3>
				
				
				
				<div style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>
				
				<div style="width:25%;float:left;">		
					<h3><label><input name="auto_play" type="checkbox" value="checkbox" <?php if($options['auto_play']) echo "checked='checked'"; ?> /> Auto play slide show</label></h3>
				</div>
				<div style="width:25%;float:left;">		
					<h3><label><input name="hide_thumbs" type="checkbox" value="checkbox" <?php if($options['hide_thumbs']) echo "checked='checked'"; ?> /> Hide thumbnails</label></h3>
				</div>
				<div style="width:25%;float:left;">		
					<h3>Slide delay in milliseconds</h3>
					<p><input type="text" name="delay" value="<?php echo($options['delay']); ?>" /></p>
				</div>
				
				<div style="width:25%;float:left;">		
					<h3>Page button size</h3>
					<p><input type="text" name="button_size" value="<?php echo($options['button_size']); ?>" /></p>
				</div>		 			


				
				<div style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>
				
				<h3 style="font-style:italic; font-weight:normal; color:grey " >In order to resize Images in WP Super Gallery try one of these plugins. Use <a title="http://wordpress.org/extend/plugins/ajax-thumbnail-rebuild/" href="http://wordpress.org/extend/plugins/ajax-thumbnail-rebuild/">AJAX thumbnail rebuild</a> or <a title="http://wordpress.org/extend/plugins/regenerate-thumbnails/" href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> </h3>

				<div style="width:25%;float:left;">				
					<h3>Thumbnail Width</h3>
					<p><input type="text" name="thumbnail_width" value="<?php echo($options['thumbnail_width']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left;">				
					<h3>Thumbnail Height</h3>
					<p><input type="text" name="thumbnail_height" value="<?php echo($options['thumbnail_height']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left">
					<h3>Main image width</h3>
					<p><input type="text" name="main_col_width" value="<?php echo($options['main_col_width']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left">
					<h3>Main image height</h3>
					<p><input type="text" name="main_col_height" value="<?php echo($options['main_col_height']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left;">
					<h3>Crop thumnails</h3>
					<h3><label><input name="thumbnail_crop" type="checkbox" value="checkbox" <?php if($options['thumbnail_crop']) echo "checked='checked'"; ?> /></label></h3>

				</div>				

				<div style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>
				
				<div style="width:25%;float:left;">		
					<h3>Number of thumbnails</h3>
					<p><input type="text" name="num_thumb" value="<?php echo($options['num_thumb']); ?>" /></p>
				</div>
					
				
				<div style="width:25%; float:left;">				
					<h3>Thumbnail column width</h3>
					<p><input type="text" name="thumb_col_width" value="<?php echo($options['thumb_col_width']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left;">				
					<h3>Thumbnail margin</h3>
					<p><input type="text" name="thumbnail_margin" value="<?php echo($options['thumbnail_margin']); ?>" /></p>
				</div>
				
				
				<div style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>
				
				
				
				<h3>Gallery width (at least Thumbnail column + Main image width)</h3>
				<p><input type="text" name="gallery_width" value="<?php echo($options['gallery_width']); ?>" /></p>
				<br />
				
				<div style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>
				
								
				<div style="width:25%; float:left;">
					<h3>Play text</h3>				
					<p><input type="text" name="play_text" value="<?php echo($options['play_text']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left;">
					<h3>Pause text</h3>					
					<p><input type="text" name="pause_text" value="<?php echo($options['pause_text']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left;">				
					<h3>Previous text</h3>	
					<p><input type="text" name="previous_text" value="<?php echo($options['previous_text']); ?>" /></p>
				</div>

				<div style="width:25%; float:left;">				
					<h3>Next text</h3>	
					<p><input type="text" name="next_text" value="<?php echo($options['next_text']); ?>" /></p>
				</div>
				
				<div style="width:25%; float:left;">				
					<h3>Download link text</h3>	
					<p><input type="text" name="download_text" value="<?php echo($options['download_text']); ?>" /></p>
				</div>

				<div style="clear:both; padding-bottom:15px; border-bottom:solid 1px #e6e6e6" ></div>

			
				<p><input class="button-primary" type="submit" name="ps_save" value="Save Changes" /></p>
			
			</form>
	
		</div>
		
		<?php
	}  
} 

function PS_getOption($option) {
    global $mytheme;
    return $mytheme->option[$option];
}

// register functions
add_action('admin_menu', array('super_plugin_options', 'update'));

$options = get_option('ps_options');

add_theme_support( 'post-thumbnails' );
add_image_size('super_thumbnails', $options['thumbnail_width'], $options['thumbnail_height'], $options['thumbnail_crop']);
add_image_size('super_full', $options['main_col_width'], $options['main_col_height']);

//============================== insert HTML header tag ========================//

wp_enqueue_script('jquery');

$super_wp_plugin_path = get_option('siteurl')."/wp-content/plugins/wpsupergallery";

wp_enqueue_style( 'super-styles', 	$super_wp_plugin_path . '/gallery.css');
if ($options['enable_history']) {											  
	wp_enqueue_script( 'history', 	$super_wp_plugin_path . '/jquery.history.js');
}
wp_enqueue_script( 'gallery', 		$super_wp_plugin_path . '/jquery.gallery.js');
wp_enqueue_script( 'opacityrollover', 	$super_wp_plugin_path . '/jquery.opacityrollover.js');



add_action( 'wp_head', 'super_wp_headers', 10 );

function super_wp_headers() {
	
	$options = get_option('ps_options');
	
	echo "<!--	super [ START ] --> \n";
	
	echo '<style type="text/css">'; 
	
	if($options['reset_css']){ 
	
		echo '
			/* reset */ 
			.super img,
			.super ul.thumbs,
			.super ul.thumbs li,
			.super ul.thumbs li a{
				padding:0;
				margin:0;
				border:none !important;
				background:none !important;
				height:auto !important;
				width:auto !important;
			}
			.super span{
				padding:0; 
				margin:0;
				border:none !important;
				background:none !important;
			}
			';
	}
	
	if(!empty($options['button_size']))
		echo '
			.super .thumnail_col a.pageLink {
				width:'.$options['button_size'] .'px;
				height:'.$options['button_size'] .'px;
			}
		';		
	
	if(!empty($options['thumb_col_width']))
		echo '	.super .thumnail_col{
					width:'. $options['thumb_col_width'] .'px;
				}
		';	
	
	if(!empty($options['main_col_width']))
		echo '	.super .gal_content,
				.super .loader,
				.super .slideshow a.advance-link{
					width:'. $options['main_col_width'] .'px;
				}
		';

	if(!empty($options['gallery_width']))
		echo '	.super{
					width:'. $options['gallery_width'] .'px;
				}
		';
		
	if(!empty($options['main_col_height']))
		echo '	.super{
					height:'. $options['main_col_height'] .'px;
				}
		';
		
	if(!empty($options['thumbnail_margin']))
		echo '	.super ul.thumbs li {
					margin-bottom:'. $options['thumbnail_margin'] .'px !important;
					margin-right:'. $options['thumbnail_margin'] .'px !important; 
				}
		';
	
	if(!empty($options['main_col_height']))
		echo '	.super .loader {
					height: '. $options['main_col_height'] / 2 . 'px;
				}
		';
		
	if(!empty($options['main_col_width']))
		echo '	.super .loader {
					width: '. $options['main_col_width'] . 'px;
				}
		';

	if(!empty($options['main_col_height']))
		echo '	.super .slideshow a.advance-link,
				.super .slideshow span.image-wrapper {
					height:'. $options['main_col_height'] .'px;
				}
		';
		
	if(!empty($options['main_col_height']))
		echo '	.super .slideshow-container {
					height:'. $options['main_col_height'] .'px;
				}
		';
			
	if($options['show_bg']){ 
	
		echo '
			.super{
				background-color:#fbefd7;
			}
			
			.super .thumnail_col {
				background-color:#e7cf9f;
			}
			
			.super .gal_content,
			.super .loader,
			.super .slideshow a.advance-link {
				background-color:#e7cf9f;
			}'; 
	}
	
	if($options['hide_thumbs']){ 
		echo '
			.super .thumnail_col{
				display:none !important;
			}
		'; 
	}
	if($options['use_paging']){ 
		echo '
			.pageLink{
				display:none !important;
			}
			.super{
				margin-top:43px;
			}
		'; 
	}

	echo '</style>'; 
			
	echo "<!--	super [ END ] --> \n";
}



add_shortcode( 'super', 'super_shortcode' );
function super_shortcode( $atts ) {
	
	global $post;
	$options = get_option('ps_options');
	
	extract(shortcode_atts(array(
		'id' 				=> intval($post->ID),
		'num_thumb' 		=> $options['num_thumb'],
		'num_preload' 		=> $options['num_thumb'],
		'show_captions' 	=> $options['show_captions'],
		'show_download' 	=> $options['show_download'],
		'show_controls' 	=> $options['show_controls'],
		'auto_play' 		=> $options['auto_play'],
		'delay' 			=> $options['delay'],
		'hide_thumbs' 		=> $options['hide_thumbs'],
		'use_paging' 		=> $options['use_paging'],
		'horizontal_thumb' 	=> 0,
		'include'    => '',
		'exclude'    => ''
	), $atts));
	
	$post_id = intval($post->ID);

	if($hide_thumbs){
		$hide_thumb_style = 'hide_me';
	}
	
	$thumb_style_init = 'display:none';
	$thumb_style_on  = "'display', 'block'";
	$thumb_style_off  = "'display', 'none'";

	
	$super_wp_plugin_path = get_option('siteurl')."/wp-content/plugins/wpsupergallery";
	
	$output_buffer ='
	
		<div class="gallery_clear"></div> 
		<div id="gallery_'.$post_id.'" class="super"> 
	
			<!-- Start Advanced Gallery Html Containers -->
			<div class="thumbs_wrap2">
				<div class="thumbs_wrap">
					<div id="thumbs_'.$post_id.'" class="thumnail_col '. $hide_thumb_style . '" >
						';
						
						if($horizontal_thumb){ 		
								$output_buffer .='<a class="pageLink prev" style="'. $thumb_style_init . '" href="#" title="Previous Page"></a>';
						}
						
						$output_buffer .=' 
						<ul class="thumbs noscript">				
						';
													
						if ( !empty($include) ) { 
							$include = preg_replace( '/[^0-9,]+/', '', $include );
							$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order') );
					
							$attachments = array();
							foreach ( $_attachments as $key => $val ) {
								$attachments[$val->ID] = $_attachments[$key];
							}
						} elseif ( !empty($exclude) ) {
							$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
							$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order') );
						} else {
							$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order') );
						}
		
						if ( !empty($attachments) ) {
							foreach ( $attachments as $aid => $attachment ) {
								$img = wp_get_attachment_image_src( $aid , 'super_full');
								$thumb = wp_get_attachment_image_src( $aid , 'super_thumbnails');
								$full = wp_get_attachment_image_src( $aid , 'full');
								$_post = & get_post($aid); 
		
								$image_title = attribute_escape($_post->post_title);
								$image_alttext = get_post_meta($aid, '_wp_attachment_image_alt', true);
								$image_caption = $_post->post_excerpt;
								$image_description = $_post->post_content;						
															
								$output_buffer .='
									<li><a class="thumb" href="' . $img[0] . '" title="' . $image_title . '" >								
											<img src="' . $thumb[0] . '" alt="' . $image_alttext . '" title="' . $image_title . '" />
										</a>
										';
		
										$output_buffer .='
										<div class="caption">
											';
											if($show_captions){ 	
												
												if($image_caption != ''){
													$output_buffer .='
														<div class="image-caption">' .  $image_caption . '</div>
													';
												}
												
												if($image_description != ''){
													$output_buffer .='
													<div class="image-desc">' .  $image_description . '</div>
													';
												} 
											}
											
											if($show_download){ 		
												$output_buffer .='
												<div class="download"><a href="'.$full[0].'">'. $options["download_text"] .'</a></div>
												';
											}
											
										$output_buffer .='
										</div>
										';
										
										
									$output_buffer .='
									</li>
								';
								} 
							} 
							
						$output_buffer .='
						</ul>';
		
						
						if(!$horizontal_thumb){ 		
								$output_buffer .='
								<div class="gallery_clear"></div>
								<a class="pageLink prev" style="'.$thumb_style_init.'" href="#" title="Previous Page"></a>';
						}
						
						$output_buffer .='
						<a class="pageLink next" style="'.$thumb_style_init.'" href="#" title="Next Page"></a>
					</div>
				</div>
			</div>
			
			<!-- Start Advanced Gallery Html Containers -->
			<div class="gal_content">
				';
				
				if($show_controls){ 
					$output_buffer .='<div id="controls_'.$post_id.'" class="controls"></div>';
				}
				
				$output_buffer .='
				<div class="slideshow-container">
					<div id="loading_'.$post_id.'" class="loader"></div>
					<div id="slideshow_'.$post_id.'" class="slideshow"></div>
					<div id="caption_'.$post_id.'" class="caption-container"></div>
				</div>
				
			</div>
	
	</div>
	
	<div class="gallery_clear"></div>
	
	';
	
	$output_buffer .= "
	
	<script type='text/javascript'>
			
			jQuery(document).ready(function($) {
				
				// We only want these styles applied when javascript is enabled
				$('.gal_content').css('display', 'block');
		
				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs_".$post_id." ul.thumbs li, .thumnail_col a.pageLink').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});	
				
				// Initialize Advanced gallery Gallery 
				var gallery = $('#thumbs_".$post_id."').gallery({ 
					delay:                     " . intval($delay) . ",
					numThumbs:                 " . intval($num_thumb) . ",
					preloadAhead:              " . intval($num_preload) . ",
					enableTopPager:            " . intval($use_paging) . ",
					enableBottomPager:         false,
					imageContainerSel:         '#slideshow_".$post_id."',
					controlsContainerSel:      '#controls_".$post_id."',
					captionContainerSel:       '#caption_".$post_id."',  
					loadingContainerSel:       '#loading_".$post_id."',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              '<span>". $options['play_text'] ."</span>',
					pauseLinkText:             '<span>". $options['pause_text'] ."</span>',
					prevLinkText:              '<span>". $options['previous_text'] ."</span>',
					nextLinkText:              '<span>". $options['next_text'] ."</span>',
					nextPageLinkText:          '&rsaquo;',
					prevPageLinkText:          '&lsaquo;',
					enableHistory:              " . intval($options['enable_history']) . ",
					autoStart:                 	" . intval($auto_play) . ",
					enableKeyboardNavigation:	true,
					syncTransitions:           	true,
					defaultTransitionDuration: 	300,
						
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onTransitionOut:           function(slide, caption, isSync, callback) {
						slide.fadeTo(this.getDefaultTransitionDuration(isSync), 0.0, callback);
						caption.fadeTo(this.getDefaultTransitionDuration(isSync), 0.0);
					},
					onTransitionIn:            function(slide, caption, isSync) {
						var duration = this.getDefaultTransitionDuration(isSync);
						slide.fadeTo(duration, 1.0);
	
						// Position the caption at the bottom of the image and set its opacity
						var slideImage = slide.find('img');
						caption.width(slideImage.width())
							.css({
								//'bottom' : Math.floor((slide.height() - slideImage.outerHeight()) / 2 - 40),
								'top' : slideImage.outerHeight(),
								'left' : Math.floor((slide.width() - slideImage.width()) / 2) + slideImage.outerWidth() - slideImage.width()
							})
							.fadeTo(1000, 1.0);
						
					},
					onPageTransitionOut:       function(callback) {
						this.hide();
						setTimeout(callback, 100); // wait a bit
					},
					onPageTransitionIn:        function() {
						var prevPageLink = this.find('a.prev').css(".$thumb_style_off.");
						var nextPageLink = this.find('a.next').css(".$thumb_style_off.");
						
						// Show appropriate next / prev page links
						if (this.displayedPage > 0)
							prevPageLink.css(".$thumb_style_on.");
		
						var lastPage = this.getNumPages() - 1;
						if (this.displayedPage < lastPage)
							nextPageLink.css(".$thumb_style_on.");
		
						this.fadeTo('fast', 1.0);
					},
					onImageAdded: function(imageData, li) {
						_li.opacityrollover({
							mouseOutOpacity:   onMouseOutOpacity,
							mouseOverOpacity:  1.0,
							fadeSpeed:         'fast',
							exemptionSelector: '.selected'
						});
					}
					
				}); 
				
				";
				
				if ($options['enable_history']) {	
					
					$output_buffer .= "
						
						/**** Functions to support integration of gallery with the jquery.history plugin ****/
		 
						// PageLoad function
						// This function is called when:
						// 1. after calling $.historyInit();
						// 2. after calling $.historyLoad();
						// 3. after pushing Go Back button of a browser
						function pageload(hash) {
							// alert('pageload: ' + hash);
							// hash doesn't contain the first # character.
							if(hash) {
								$.gallery.gotoImage(hash);
							} else {
								gallery.gotoIndex(0);
							}
						}
		 
						// Initialize history plugin.
						// The callback is called at once by present location.hash. 
						$.historyInit(pageload, 'advanced.html');
		 
						// set onlick event for buttons using the jQuery 1.3 live method
						$('a[rel=history]').live('click', function(e) {
							if (e.button != 0) return true;
							
							var hash = this.href;
							hash = hash.replace(/^.*#/, '');
		 
							// moves to a new page. 
							// pageload is called at once.  
							$.historyLoad(hash);
		 
							return false;
						});
		 
						/****************************************************************************************/
						
						
						";
				}
				
			if($use_hover){ 		
		 
				$output_buffer .= "
					gallery.find('a.thumb').hover(function(e) {
						gallery.clickHandler(e, this);
					});
				";
		
			} 
					
				
			$output_buffer .= "
				
				/**************** Event handlers for custom next / prev page links **********************/
		
				gallery.find('a.prev').click(function(e) {
					gallery.previousPage();
					e.preventDefault();
				});
		
				gallery.find('a.next').click(function(e) {
					gallery.nextPage(); 
					e.preventDefault();
				});
		
			});
		</script>
		
		";
		
		return $output_buffer;
}