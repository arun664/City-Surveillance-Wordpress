<div class="front_page_section front_page_section_blog<?php
			$prolingua_scheme = prolingua_get_theme_option('front_page_blog_scheme');
			if (!prolingua_is_inherit($prolingua_scheme)) echo ' scheme_'.esc_attr($prolingua_scheme);
			echo ' front_page_section_paddings_'.esc_attr(prolingua_get_theme_option('front_page_blog_paddings'));
		?>"<?php
		$prolingua_css = '';
		$prolingua_bg_image = prolingua_get_theme_option('front_page_blog_bg_image');
		if (!empty($prolingua_bg_image)) 
			$prolingua_css .= 'background-image: url('.esc_url(prolingua_get_attachment_url($prolingua_bg_image)).');';
		if (!empty($prolingua_css))
			echo ' style="' . esc_attr($prolingua_css) . '"';
?>><?php
	// Add anchor
	$prolingua_anchor_icon = prolingua_get_theme_option('front_page_blog_anchor_icon');	
	$prolingua_anchor_text = prolingua_get_theme_option('front_page_blog_anchor_text');	
	if ((!empty($prolingua_anchor_icon) || !empty($prolingua_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_blog"'
										. (!empty($prolingua_anchor_icon) ? ' icon="'.esc_attr($prolingua_anchor_icon).'"' : '')
										. (!empty($prolingua_anchor_text) ? ' title="'.esc_attr($prolingua_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_blog_inner<?php
			if (prolingua_get_theme_option('front_page_blog_fullheight'))
				echo ' prolingua-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$prolingua_css = '';
			$prolingua_bg_mask = prolingua_get_theme_option('front_page_blog_bg_mask');
			$prolingua_bg_color = prolingua_get_theme_option('front_page_blog_bg_color');
			if (!empty($prolingua_bg_color) && $prolingua_bg_mask > 0)
				$prolingua_css .= 'background-color: '.esc_attr($prolingua_bg_mask==1
																	? $prolingua_bg_color
																	: prolingua_hex2rgba($prolingua_bg_color, $prolingua_bg_mask)
																).';';
			if (!empty($prolingua_css))
				echo ' style="' . esc_attr($prolingua_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_blog_content_wrap content_wrap">
			<?php
			// Caption
			$prolingua_caption = prolingua_get_theme_option('front_page_blog_caption');
			if (!empty($prolingua_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_blog_caption front_page_block_<?php echo !empty($prolingua_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($prolingua_caption); ?></h2><?php
			}
		
			// Description (text)
			$prolingua_description = prolingua_get_theme_option('front_page_blog_description');
			if (!empty($prolingua_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_blog_description front_page_block_<?php echo !empty($prolingua_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($prolingua_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_blog_output"><?php 
				if (is_active_sidebar('front_page_blog_widgets')) {
					dynamic_sidebar( 'front_page_blog_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!prolingua_exists_trx_addons())
						prolingua_customizer_need_trx_addons_message();
					else
						prolingua_customizer_need_widgets_message('front_page_blog_caption', 'ThemeREX Addons - Blogger');
				}
			?></div>
		</div>
	</div>
</div>