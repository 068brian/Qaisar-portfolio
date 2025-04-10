<?php if (!defined('FW')) die('Forbidden'); ?>

<?php
	$id_to_class = array(
		'1_6' => 'col-xs-12 col-sm-2',
		'1_4' => 'col-xs-12 col-sm-3',
		'1_3' => 'col-xs-12 col-sm-4',
		'1_2' => 'col-xs-12 col-sm-6',
		'2_3' => 'col-xs-12 col-sm-8',
		'3_4' => 'col-xs-12 col-sm-9',
		'1_1' => 'col-xs-12 col-sm-12'
	);

    if($atts['tablet'] !=''){
    	$id_to_class = array(
			'1_6' => 'col-lg-2',
			'1_4' => 'col-lg-3',
			'1_3' => 'col-lg-4',
			'1_2' => 'col-lg-6',
			'2_3' => 'col-lg-8',
			'3_4' => 'col-lg-9',
			'1_1' => 'col-lg-12'
		);
        $id_tablet_class = array(
            'fw-col-sm-2' => 'col-xs-12 col-md-2',
            'fw-col-sm-3' => 'col-xs-12 col-md-3',
            'fw-col-sm-4' => 'col-xs-12 col-md-4',
            'fw-col-sm-6' => 'col-xs-12 col-md-6',
            'fw-col-sm-8' => 'col-xs-12 col-md-8',
            'fw-col-sm-9' => 'col-xs-12 col-md-9',
            'fw-col-sm-12' => 'col-xs-12 col-md-12'
        );
    }

	$atts['padding_top'] = (int)$atts['padding_top'];
	$atts['padding_right'] = (int)$atts['padding_right'];
	$atts['padding_bottom'] = (int)$atts['padding_bottom'];
	$atts['padding_left'] = (int)$atts['padding_left'];
    $custom_styles = "{$atts['padding_top']}px {$atts['padding_right']}px {$atts['padding_bottom']}px {$atts['padding_left']}px";
    $id = uniqid( 'id-' );
?>

<div class="<?php if($atts['tablet'] !=''){ echo esc_attr($id_tablet_class[$atts['tablet']]); } ?> <?php echo esc_attr($id_to_class[$atts['width']]); ?> <?php echo esc_attr($atts['class']); ?>">
    <div id="col_inner_<?php echo esc_attr($id); ?>" class="fw-col-inner" data-paddings="<?php echo esc_attr($custom_styles); ?>">
		<?php echo do_shortcode($content); ?>
	</div>
</div>
