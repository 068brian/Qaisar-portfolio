<?php
	
	echo fw_html_tag('button', 
		array(
			'type'  => 'button',
			'class' => 'button add-new-item settings-export-button',
			'id'	=> $data['id_prefix'] . $id . '-copy-data'
		), 
		esc_html__('Copy Data', 'fw')
	);

	echo '<a href="' . esc_url( $export_url ) . '">';
	
	echo fw_html_tag('button', 
		array(
			'type'  => 'button',
			'class' => 'button button-primary add-new-item settings-export-button',
			'id'	=> $data['id_prefix'] . $id . '-download-data',
		),
		esc_html__('Download Data File', 'fw')
	);

	echo '</a>';


	echo fw_html_tag('button', 
		array(
			'type'  => 'button',
			'class' => 'button add-new-item settings-export-button',
			'id'	=> $data['id_prefix'] . $id . '-copy-url'
		),
		esc_html__('Copy Export URL', 'fw')
	);


	echo '<br />';


	echo fw()->backend->option_type('textarea')->render('txt-copy-data',
		array( 
			'attr'	=>	array( 
				'class'	=>	'settings-export-textarea fw-hidden',
				'rows'			=>	3,
			),
			'value'	=>	$export_data
		),
		array(
			'id_prefix' => $data['id_prefix'] . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	);


	echo fw()->backend->option_type('textarea')->render('txt-copy-url',
		array( 
			'attr'	=>	array( 
				'class'	=>	'settings-export-textarea fw-hidden',
				'rows'			=>	3,
			),
			'value'	=>	$export_url
		),
		array(
			'id_prefix' => $data['id_prefix'] . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	);

?>