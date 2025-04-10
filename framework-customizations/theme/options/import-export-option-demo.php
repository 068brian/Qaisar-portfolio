<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'import_export_tab' => array(
		'title'   => esc_html__( 'Import / Export', 'kerge' ),
		'type'    => 'tab',
		'options' => array(
			'import'	=>	array(
				'type'	=>	'settings-import',
				'label' =>	esc_html__('Import Options', 'kerge'),
                'desc'  =>	esc_html__('WARNING! This will overwrite all existing option values, please proceed with caution!', 'kerge'),
			),
			'export'	=>	array(
				'type'	=>	'settings-export',
				'label' =>	esc_html__('Export Options', 'kerge'),
                'desc'  =>	esc_html__('Here you can copy/download your current option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', 'kerge'),
			)
		)
	)
);
