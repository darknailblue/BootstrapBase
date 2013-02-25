<?php
/**
 * Initialize the options before anything else.
 */
add_action('admin_init', 'bsb_custom_theme_options', 1);



/**
 * Build the custom settings & update OptionTree.
 */
if ( !function_exists( 'bsb_custom_theme_options' ) ) {
	function bsb_custom_theme_options() {
		/**
		 * Get a copy of the saved settings array. 
		 */
		$saved_settings = get_option('option_tree_settings', array());
		
		/**
		 * Custom settings array that will eventually be 
		 * passes to the OptionTree Settings API Class.
		 */
		$custom_settings = array(
			'contextual_help' => array(
				
				'sidebar' => ''
			),
			'sections' => array(
				array(
					'id' => 'general',
					'title' => 'General'
				),
				array(
					'id' => 'typography',
					'title' => 'Typography'
				),
				array(
					'id' => 'design',
					'title' => 'Backgrounds'
				),
				array(
					'id' => 'headerdesign',
					'title' => 'Header Design'
				),
				array(
					'id' => 'blogdesign',
					'title' => 'Blog Design'
				),
				array(
					'id' => 'footerdesign',
					'title' => 'Footer Design'
				),
				array(
					'id' => 'social',
					'title' => 'Social'
				),
				array(
					'id' => 'thumbnails',
					'title' => 'Thumbnails'
				),
				array(
					'id' => 'behavior',
					'title' => 'Behavior'
				),
				array(
					'id' => 'advanced',
					'title' => 'Advanced'
				)
			),
			'settings' => array(
				 array(
					'label'       => 'Custom Thumbnails',
					'id'          => 'customthumbnails',
					'type'        => 'list-item',
					'desc'        => 'Use this tool to add custom thumbnails to your site.',
					'section'	  => 'thumbnails',
					'settings'    => array(
						array(
							'label'       => 'ID',
							'id'          => 'thumbnailid',
							'type'        => 'text',
							'desc'        => 'Enter the ID of the thumbnail.  This is used so that the thumbnail can be accessed programatically.  NOTE: Only enter lowercase characters and underscores and do not use native WordPress thumbnail identifiers (thumb, thumbnail, medium, large, post-thumbnail).',
						),
						array(
							'label'       => 'Width',
							'id'          => 'thumbnailwidth',
							'type'        => 'text',
							'desc'        => 'Enter the width of the thumbnail in pixels.  NOTE: Only enter a numeric value.',
						),
						array(
							'label'       => 'Height',
							'id'          => 'thumbnailheight',
							'type'        => 'text',
							'desc'        => 'Enter the height of the thumbnail in pixels.  NOTE: Only enter a numeric value.',
						),
						array(
							'label'       => 'Fixed Crop',
							'id'          => 'fixedcrop',
							'type'        => 'checkbox',
							'desc'        => 'If enabled, this will keep the thumbnail size the EXACT dimensions regardless of image size.',
							'choices'     => array(
							  array (
								'label'       => 'Enabled',
								'value'       => 'enabled'
							  )
							)
						  )
					)
				),
				array(
					'id' => 'logo',
					'label' => 'Logo',
					'desc' => 'Upload a logo for your site or Boostrap Base will use the default site name.',
					'std' => '',
					'type' => 'upload',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'logotitle',
					'label' => 'Logo Title / Alt Text',
					'desc' => 'Use a good text description for the logo',
					'std' => 'Testing Defaults',
					'type' => 'text',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'latitude',
					'label' => 'Latitude Coordinate',
					'desc' => "Enter the lat coordinate to take advantage of Bing's geo location features. ",
					'std' => '',
					'type' => 'text',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'longitude',
					'label' => 'Longitude Coordinate',
					'desc' => "Enter the long coordinate to take advantage of Bing's geo location features. ",
					'std' => '',
					'type' => 'text',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'favicon',
					'label' => 'Favicon 16x16',
					'desc' => 'For nokia devices and desktop/laptop web browsers',
					'std' => '',
					'type' => 'upload',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'favicon57',
					'label' => 'Favicon 57x57',
					'desc' => 'For non-Retina iPhone, iPod Touch, and Android 2.1+ devices',
					'std' => '',
					'type' => 'upload',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'favicon72',
					'label' => 'Favicon 72x72',
					'desc' => 'For first-generation iPad',
					'std' => '',
					'type' => 'upload',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'favicon114',
					'label' => 'Favicon 114x114',
					'desc' => 'For iPhone 4 with high-resolution Retina display',
					'std' => '',
					'type' => 'upload',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'favicon144',
					'label' => 'Favicon 144x144',
					'desc' => 'For third generation iPad Retina Display',
					'std' => '',
					'type' => 'upload',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'footertext',
					'label' => 'Footer Credit Text',
					'desc' => '',
					'std' => '',
					'type' => 'textarea',
					'section' => 'general',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'mainfont',
					'label' => 'Main Font',
					'desc' => 'You know what this does :)',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'morefooterfont',
					'label' => 'More Footer Font',
					'desc' => 'You know what this does :)',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'endfooterfont',
					'label' => 'End Footer Font',
					'desc' => 'You know what this does :)',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'links',
					'label' => 'Links',
					'desc' => 'Default link normal state',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'linkhover',
					'label' => 'Link Hover',
					'desc' => 'Default link hover state',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'caption',
					'label' => 'Image Captions',
					'desc' => 'Font treatments that will be used for Image captions',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'minimumthreshold',
					'label' => 'Font Minimum Threshold',
					'desc' => 'When headers are scaled, they will not be scaled smaller than this value.  NOTE: Only use an integer for best results',
					'std' => '14',
					'type' => 'text',
					'section' => 'typography'
				),
				array(
					'id' => 'largedesktoppercentage',
					'label' => 'Large Desktop Font Ratio',
					'desc' => 'NOTE: This number is multipled.  At most use 1 smallest can be some decimal.',
					'std' => '1',
					'type' => 'text',
					'section' => 'typography'
				),
				array(
					'id' => 'normaldesktoppercentage',
					'label' => 'Normal Desktop Font Ratio',
					'desc' => 'NOTE: This number is multipled.  At most use 1 smallest can be some decimal.',
					'std' => '1',
					'type' => 'text',
					'section' => 'typography'
				),
				array(
					'id' => 'tabletpercentage',
					'label' => 'Tablet Font Ratio',
					'desc' => 'NOTE: This number is multipled.  At most use 1 smallest can be some decimal.',
					'std' => '.8',
					'type' => 'text',
					'section' => 'typography'
				),
				array(
					'id' => 'landscapephonepercentage',
					'label' => 'Landscape Phone Font Ratio',
					'desc' => 'NOTE: This number is multipled.  At most use 1 smallest can be some decimal.',
					'std' => '.7',
					'type' => 'text',
					'section' => 'typography'
				),
				array(
					'id' => 'portraitphonepercentage',
					'label' => 'Portrait Phone Font Ratio',
					'desc' => 'NOTE: This number is multipled.  At most use 1 smallest can be some decimal.',
					'std' => '.6',
					'type' => 'text',
					'section' => 'typography'
				),
				array(
					'id' => 'entrytitle',
					'label' => 'Primary Titles',
					'desc' => 'This font will be used for the main headings on entries such as post titles, pages titles, etc.  Make sure to use the .entry-title class in your theme to take advantage of this.',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'subheader',
					'label' => 'Subheader',
					'desc' => 'This font will be used for the sub header on entries such as post titles, pages titles, etc.  The subheader can be accessed via CSS with the .entry-subheader class.',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'secondarytitle',
					'label' => 'Secondary Titles',
					'desc' => 'This font will be used for the secondary headings in content areas and h2 tags.',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'tertiarytitle',
					'label' => 'Tertiary Titles',
					'desc' => 'This font will be used for the tertiary headings such as sidebars and h3 tags.',
					'std' => '',
					'type' => 'typography',
					'section' => 'typography',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'background',
					'label' => 'Body Background',
					'desc' => 'This will be used in the body tag.',
					'std' => '',
					'type' => 'background',
					'section' => 'design',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'backgroundlayer1',
					'label' => 'Layer 1 Backround',
					'desc' => 'This will be used in the layer 1 div.',
					'std' => '',
					'type' => 'background',
					'section' => 'design',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'backgroundlayer2',
					'label' => 'Layer 2 Backround',
					'desc' => 'This will be used in the layer 2 div.',
					'std' => '',
					'type' => 'background',
					'section' => 'design',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'headerbackground',
					'label' => 'Header Background',
					'desc' => '',
					'std' => '',
					'type' => 'background',
					'section' => 'design',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'morefooterbackground',
					'label' => 'More Footer Background',
					'desc' => '',
					'std' => '',
					'type' => 'background',
					'section' => 'design',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'endfooterbackground',
					'label' => 'End Footer Background',
					'desc' => '',
					'std' => '',
					'type' => 'background',
					'section' => 'design',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'font_awesome',
					'label' => 'Font Awesome',
					'desc' => 'Enable this option to take advantage of the font awesome library.',
					'std' => 'enabled',
					'type' => 'checkbox',
					'section' => 'advanced',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'enabled',
							'label' => 'Enabled'
						)
					)
				),
				array(
					'id' => 'animate',
					'label' => 'Animate.css',
					'desc' => 'Enable this option to take advantage of the animate.css library.',
					'std' => 'enabled',
					'type' => 'checkbox',
					'section' => 'advanced',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'enabled',
							'label' => 'Enabled'
						)
					)
				),
				array(
					'id' => 'pricing',
					'label' => 'Pricing.css',
					'desc' => 'Enable this option to enable custom pricing grids.',
					'std' => 'enabled',
					'type' => 'checkbox',
					'section' => 'advanced',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'enabled',
							'label' => 'Enabled'
						)
					)
				),
				array(
					'id' => 'htmlnamespace',
					'label' => 'HTML Namespace',
					'desc' => 'Use this for Facebook and other app integrations',
					'std' => '',
					'type' => 'text',
					'section' => 'advanced'
				),
				array(
					'id' => 'customcss',
					'label' => 'Custom CSS',
					'desc' => '',
					'std' => '',
					'type' => 'css',
					'section' => 'advanced',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'iconset',
					'label' => 'Icon Set',
					'desc' => 'Choose the social icon set to use.',
					'std' => '',
					'type' => 'select',
					'section' => 'social',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'icontexto-inside',
							'label' => 'Icontexto Inside'
						),
						array(
							'value' => 'wp-zoom',
							'label' => 'WPZoom'
						)
					)
				),
				array(
					'id' => 'feed',
					'label' => 'Display Feed',
					'desc' => 'Enable this option to display the feed in the social icon section.',
					'std' => 'enabled',
					'type' => 'checkbox',
					'section' => 'social',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'enabled',
							'label' => 'Enabled'
						)
					)
				),
				array(
					'id' => 'facebook',
					'label' => 'Facebook URL',
					'desc' => 'Use your entire Facebook URL.',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'twitter',
					'label' => 'Twitter Username',
					'desc' => 'Use just your twitter username. Do not include the @ sign.',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'linkedin',
					'label' => 'LinkedIn URL',
					'desc' => 'Use your entire LinkedIn URL.',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'googleplus',
					'label' => 'Google+ ID',
					'desc' => 'Just the Google+ ID',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'youtube',
					'label' => 'YouTube URL',
					'desc' => 'Use your entire YouTube URL.',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'Vimeo',
					'label' => 'Vimeo URL',
					'desc' => 'Use your entire Vimeo URL.',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'instagram',
					'label' => 'Instagram URL',
					'desc' => 'Use just your Instagram username.',
					'std' => '',
					'type' => 'text',
					'section' => 'social',
					'rows' => '',
					'post_type' => '',
					'taxonomy' => '',
					'class' => ''
				),
				array(
					'id' => 'logoposition',
					'label' => 'Menu / Logo Layout',
					'desc' => 'This option controls how to the logo sits within the menu.  If center is selected a left and right menu option will be enabled.',
					'std' => 'left',
					'type' => 'radio-image',
					'section' => 'headerdesign',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'left',
							'label' => 'Left',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/logo-left.jpg'
						),
						array(
							'value' => 'center',
							'label' => 'Center',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/logo-center.jpg'
						),
						array(
							'value' => 'right',
							'label' => 'Right',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/logo-right.jpg'
						)
					)
				),
				array(
					'id' => 'menuposition',
					'label' => 'Header Position',
					'desc' => 'Control how your menu sits on the page.  Standard, Absolute, Fixed',
					'std' => 'standard',
					'type' => 'radio',
					'section' => 'headerdesign',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'standard',
							'label' => 'Standard'
						),
						array(
							'value' => 'absolute',
							'label' => 'Absolute'
						),
						array(
							'value' => 'fixed',
							'label' => 'Fixed'
						)
					)
				),
				array(
					'label'       => 'Header Top Margin',
					'id'          => 'menutopmargin',
					'type'        => 'measurement',
					'desc'        => 'This will assign a top margin to the header.  Use this value to move the entire menu / header down.  NOTE: Only use numbers.',
					'section'     => 'headerdesign'
				),
				array(
					'label'       => 'Menu Background Color',
					'id'          => 'menubackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Assign a background color to the entire menu',
					'section'     => 'headerdesign'
				),
				array(
					'label'       => 'Menu Background Opacity',
					'id'          => 'menubackgroundopacity',
					'type'        => 'text',
					'desc'        => 'Change the menus background opacity.  NOTE: Only use numbers (.1 - 1).',
					'section'     => 'headerdesign'
				),
				array(
					'id' => 'menuitemalignment',
					'label' => 'Menu Item Alignment',
					'desc' => 'Control how your menu items align in dektop modes',
					'std' => 'right',
					'type' => 'radio',
					'section' => 'headerdesign',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'left',
							'label' => 'Left'
						),
						array(
							'value' => 'right',
							'label' => 'Right'
						)
					)
				),
				array(
					'label'       => 'Menu Item Top Margin',
					'id'          => 'menuitemtopmargin',
					'type'        => 'measurement',
					'desc'        => 'This will assign a top margin to the menu. Use this value to vertically align menu items with the logo.  NOTE: Only use numbers.',
					'section'     => 'headerdesign',
					'std'		  => array(
						0	=> 20,
						1	=> 'px'
					)
				),
				array(
					'label'       => 'Menu Item Border Radius',
					'id'          => 'menuitemborderradius',
					'type'        => 'measurement',
					'desc'        => 'This will assign a border radius to the menu. NOTE: Only use numbers.',
					'section'     => 'headerdesign'
				),
				array(
					'id' => 'normalstatemenufont',
					'label' => 'Normal State Menu Font',
					'desc' => 'This will determine the font to be used for the normal menu item state.',
					'type' => 'typography',
					'section' => 'headerdesign'
				),
				array(
					'label'       => 'Normal State Menu Background Color',
					'id'          => 'normalstatemenubackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Assign a background color to the normal menu item state.',
					'section'     => 'headerdesign'
				),
				array(
					'label'       => 'Normal State Caret Color',
					'id'          => 'normalstatecaretcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Color of the caret for the normal drop-down menu state.',
					'section'     => 'headerdesign',
					'std'			=> '#666666'
				),
				
				array(
					'id'		=>	'hoverstatemenufont',
					'label'		=> 	'Hover State Menu Font',
					'desc'		=>	'This will determine the font to be used for the hover menu item state.',
					'type'		=>	'typography',
					'section'	=>	'headerdesign',
					'std'		=>	array(
						'font-color' => '#ffffff'
					)
				),
				array(
					'label'       	=> 'Hover State Menu Background Color',
					'id'          	=> 'hoverstatemenubackgroundcolor',
					'type'        	=> 'colorpicker',
					'desc'        	=> 'Assign a background color to the hover menu item state.',
					'section'		=> 'headerdesign',
					'std'			=> '#000000'
				),
				
				array(
					'label'       => 'Hover State Caret Color',
					'id'          => 'hoverstatecaretcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Color of the caret for the hover drop-down menu state.',
					'section'     => 'headerdesign',
					'std'			=> '#ffffff'
				),
				
				array(
					'id' => 'activestatemenufont',
					'label' => 'Active State Menu Font',
					'desc' => 'This will determine the font to be used for the active menu item state.',
					'type' => 'typography',
					'section' => 'headerdesign',
					'std'		=>	array(
						'font-color' => '#ffffff'
					)
				),
				array(
					'label'       => 'Active State Menu Background Color',
					'id'          => 'activestatemenubackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Assign a background color to the active menu item state.',
					'section'     => 'headerdesign',
					'std'			=> '#5454ff'
				),
				array(
					'label'       => 'Active State Caret Color',
					'id'          => 'activestatecaretcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Color of the caret for the active drop-down menu state.',
					'section'     => 'headerdesign',
					'std'			=> '#ffffff'
				),
				array(
					'label'		  => 'Drop Down Normal State Menu Font',
					'id'		  => 'dropdownnormalstatemenufont',
					'type'		  => 'typography',
					'desc'		  => 'This will determine the font to be used for the normal menu item state of drop downs.',
					'section'	  => 'headerdesign'
				),
				array(
					'label'       => 'Drop Down Normal State Menu Background Color',
					'id'          => 'dropdownnormalstatemenubackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Assign a background color to the normal menu item state of drop downs.',
					'section'     => 'headerdesign'
				),
				array(
					'label'		  => 'Drop Down Hover State Menu Font',
					'id'		  => 'dropdownhoverstatemenufont',
					'type'		  => 'typography',
					'desc'		  => 'This will determine the font to be used for the hover menu item state of drop downs.',
					'section'	  => 'headerdesign'
				),
				array(
					'label'       => 'Drop Down Hover State Menu Background Color',
					'id'          => 'dropdownhoverstatemenubackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Assign a background color to the hover menu item state of drop downs.',
					'section'     => 'headerdesign'
				),
				array(
					'label'		  => 'Drop Down Active State Menu Font',
					'id'		  => 'dropdownactivestatemenufont',
					'type'		  => 'typography',
					'desc'		  => 'This will determine the font to be used for the active menu item state of drop downs.',
					'section'	  => 'headerdesign'
				),
				array(
					'label'       => 'Drop Down Active State Menu Background Color',
					'id'          => 'dropdownactivestatemenubackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Assign a background color to the active menu item state of drop downs.',
					'section'     => 'headerdesign'
				),
				
				array(
					'id' => '3dbackground',
					'label' => 'Enable 3D Background',
					'desc' => 'This will enable a sweet scrolling effect',
					'std' => 'enabled',
					'type' => 'checkbox',
					'section' => 'behavior',
					'class' => '3dbackground',
					'choices' => array(
						array(
							'value' => 'enabled',
							'label' => 'Enabled'
						)
					)
				),
				array(
					'id' => '3dlayer',
					'label' => '3D Layer',
					'desc' => 'Select which layer will have the 3D scroll effect.',
					'std' => 'body',
					'type' => 'radio',
					'section' => 'behavior',
					'class' => 'layer',
					'choices' => array(
						array(
							'value' => 'body',
							'label' => '<body> tag'
						),
						array(
							'value' => '#layer1',
							'label' => '#layer1'
						),
						array(
							'value' => '#layer2',
							'label' => '#layer2'
						)
					)
				),
				array(
					'label'       => 'Scroll Offset',
					'id'          => 'scrolloffset',
					'type'        => 'text',
					'desc'        => 'This value will determine the 3D scroll offset.  Please use ONLY numbers.  NOTE:  A lower number will create a more dramatic effect.',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'behavior'
				),
				array(
					'id' => 'nicemobilemenu',
					'label' => 'Enable Nice Mobile Menu',
					'desc' => 'Make your mobile menu look awesome.',
					'std' => 'enabled',
					'type' => 'checkbox',
					'section' => 'behavior',
					'choices' => array(
						array(
							'value' => 'enabled',
							'label' => 'Enabled'
						)
					)
				),
				array(
					'id' => 'morefooterlayout',
					'label' => 'More Footer Layout',
					'desc' => 'Select a layout for the More Footer Section. Depending on which layout you select will determine what kind of widget areas will be available.',
					'std' => '',
					'type' => 'radio-image',
					'section' => 'footerdesign',
					'class' => '',
					'choices' => array(
						array(
							'value' => 'full',
							'label' => 'Full',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/full.jpg'
						),
						array(
							'value' => '5050',
							'label' => '50 / 50',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/5050.jpg'
						),
						
						array(
							'value' => '25252525',
							'label' => '25 / 25 / 25 / 25',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/25252525.jpg'
						),
						
						
						array(
							'value' => '255025',
							'label' => '25 / 50 / 25',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/255025.jpg'
						),
						array(
							'value' => '252550',
							'label' => '25 / 25 / 50',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/252550.jpg'
						),
						array(
							'value' => '502525',
							'label' => '50 / 25 / 25',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/502525.jpg'
						),
						array(
							'value' => '333333',
							'label' => '33 / 33 / 33',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/333333.jpg'
						),
						array(
							'value' => '6633',
							'label' => '66 / 33',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/6633.jpg'
						),
						array(
							'value' => '3366',
							'label' => '33 / 66',
							'src'	=> BSB_ROOT_PATH . '/option-tree/assets/images/3366.jpg'
						)
					)
				),
				array(
					'id'		=> 'blogsidebarposition',
					'label'		=> 'Blog Sidebar Position',
					'desc'		=> 'Select a position for the blog sidebar.',
					'type'		=> 'radio',
					'section'	=> 'blogdesign',
					'std'		=> 'right',
					'choices' => array(
						array(
							'value' => 'right',
							'label' => 'Right'
						),
						array(
							'value' => 'left',
							'label' => 'Left'
						)
					)
				),
				array(
					'id'		=> 'blogsidebarcolumnwidth',
					'label'		=> 'Blog Sidebar Column Width',
					'desc'		=> 'Select a width for the blog sidebar.  These widths are based off of Bootstraps 12 column grid system.',
					'type'		=> 'radio',
					'std'		=> '3',
					'section'	=> 'blogdesign',
					'choices' => array(
						array(
							'value' => '3',
							'label' => '3 Column'
						),
						array(
							'value' => '4',
							'label' => '4 Column'
						),
						array(
							'value' => '5',
							'label' => '5 Column'
						),
						array(
							'value' => '6',
							'label' => '6 Column'
						)
					)
				),
				array(
					'id'		=> 'blogarchiveitemtitle',
					'label'		=> 'Blog Archive Item Title',
					'desc'		=> 'This will determine the font to be used for the blog archive article headers.',
					'type'		=> 'typography',
					'section'	=> 'blogdesign'
				),
				array(
					'label'       => 'Archive Featured Image Size',
					'id'          => 'archivefeaturedimagesize',
					'type'        => 'measurement',
					'desc'        => 'Determine the dimensions of the featured image in the archives page.',
					'section'     => 'blogdesign',
				),
				array(
					'id'		=> 'archivethumbnailposition',
					'label'		=> 'Archive Thumbnail Position',
					'desc'		=> 'Select a position for the archive thumbnail position.',
					'type'		=> 'radio',
					'section'	=> 'blogdesign',
					'std'		=> 'right',
					'choices' => array(
						array(
							'value' => 'right',
							'label' => 'Right'
						),
						array(
							'value' => 'left',
							'label' => 'Left'
						)
					)
				),
				array(
					'label'       => 'Comment Item Border Radius',
					'id'          => 'commentitemborderradius',
					'type'        => 'measurement',
					'desc'        => 'The border radius of comment items.',
					'section'     => 'blogdesign',
				),
				array(
					'label'       => 'Comment Item Background Color',
					'id'          => 'commentitembackgroundcolor',
					'type'        => 'colorpicker',
					'desc'        => 'Comment item background color.',
					'section'     => 'blogdesign'
				)
			)
		);
		
		/* settings are not the same update the DB */
		if ($saved_settings !== $custom_settings) {
			update_option('option_tree_settings', $custom_settings);
		}
		
	}
}