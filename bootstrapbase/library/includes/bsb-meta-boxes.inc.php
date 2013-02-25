<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

function custom_meta_boxes() {

  $my_meta_box = array(
    'id'        => 'my_meta_box',
    'title'     => 'Page Specific Settings / Overrides',
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
		array(
			'id'          => 'subheader',
			'label'       => 'Subheader',
			'desc'        => 'This will go next to the header',
			'type'        => 'text',
		  ),
		array(
			'id'          => 'bodybackground',
			'label'       => 'Body Background',
			'type'        => 'background',
			'desc'        => 'Override the Body Background'
		),
		array(
			'id'          => 'layer1background',
			'label'       => 'Layer 1 Background',
			'type'        => 'background',
			'desc'        => 'Override the Layer 1 Background'
		),
		array(
			'id'          => 'layer2background',
			'label'       => 'Layer 2 Background',
			'type'        => 'background',
			'desc'        => 'Override the Layer 2 Background'
		)
    )
  );
  
  ot_register_meta_box( $my_meta_box );

}