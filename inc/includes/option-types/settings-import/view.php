<?php
	
	echo fw_html_tag('button', 
		array(
			'type' => 'button',
			'class' => 'button button-primary add-new-item slz-import-button',
			'id'	=> $data['id_prefix'] . $id . '-btn-import-file'
		),
		esc_html__('Import from File', 'fw')
	);

	echo fw_html_tag('button', 
		array(
			'type' => 'button',
			'class' => 'button add-new-item',
			'id'	=> $data['id_prefix'] . $id . '-btn-import-url'
		),
		esc_html__('Import from URL', 'fw')
	);

	echo '<br />';

	echo fw()->backend->option_type('textarea')->render('import-file',
		array( 
			'attr'	=>	array( 
				'class'	=>	'slz-import-textarea',
				'rows'			=>	5,
				'placeholder'	=>	esc_html__('Input your backup file below and hit Import to restore your sites options from a backup.', 'fw')
			),
		),
		array(
			'id_prefix' => $data['id_prefix'] . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	);

	echo fw()->backend->option_type('textarea')->render('import-url',
		array( 
			'attr'	=>	array( 
				'class' 		=> 'slz-import-textarea fw-hidden',
				'rows'			=>	3,
				'placeholder'	=>	esc_html__('Input the URL to another sites options set and hit Import to load the options from that site.', 'fw')
			),
		),
		array(
			'id_prefix' => $data['id_prefix'] . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	);

	echo '<br />';

	echo fw_html_tag('button', 
		array(
			'type' => 'button',
			'class' => 'button button-primary add-new-item',
			'id'	=> $data['id_prefix'] . $id . '-btn-import-submit',
			'import-from'	=> 	'file'
		), 
		esc_html__('Import', 'fw')
	);

?>