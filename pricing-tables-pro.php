<?php
/*
Plugin Name: Pricing Tables Pro
Plugin URI: https://metrocraft.com/plugins/pricing-tables/
Description: A pricing table plugin.
Version: 1.0.0
Author: Metrocraft
Author URI: https://metrocraft.com
License: GPL2
*/

/* This plugin was forked and further modified from the Responsive Pricing Table plugin by WP Darko */

/* Enqueue styles */
function mc_ptp_scripts() {
	wp_enqueue_style( 'pricing-tables-pro', plugins_url( 'css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'mc_ptp_scripts', 99 );

/* Enqueue admin styles */
function mc_ptp_admin_scripts() {
	wp_enqueue_style( 'pricing-tables-pro-admin', plugins_url( 'css/admin.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'mc_ptp_admin_scripts' );

// Create Pricing Table custom type
function mc_ptp_register_post_type() {
	register_post_type( 'mc_ptp_pricing_table',
		array(
		'labels' => array(
		'name' => 'Pricing Tables',
		'singular_name' => 'Pricing Table',
		),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'supports'           => array( 'title' ),
		'menu_icon'    => 'dashicons-plus',
		)
	);
}
add_action( 'init', 'mc_ptp_register_post_type' );

/* Hide View/Preview since it's a shortcode */
function mc_ptp_pricing_table_admin_css() {
	global $post_type;
	$post_types = array(
						'mc_ptp_pricing_table',
				  );
	if ( in_array( $post_type, $post_types ) ) {
		echo '<style type="text/css">#post-preview, #view-post-btn {display: none;}</style>'; }
}

function mc_ptp_remove_view_link( $action ) {

	unset( $action['view'] );
	return $action;
}

add_filter( 'post_row_actions', 'mc_ptp_remove_view_link' );
add_action( 'admin_head-post-new.php', 'mc_ptp_pricing_table_admin_css' );
add_action( 'admin_head-post.php', 'mc_ptp_pricing_table_admin_css' );

// Adding the CMB2 Metabox class
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

// Registering Pricing Table metaboxes
function mc_ptp_register_plan_group_metabox() {

	$prefix = '_mc_ptp_';

	// Tables group
	$main_group = new_cmb2_box( array(
		'id' => $prefix . 'plan_metabox',
		'title' => 'Pricing Table Plans',
		'object_types' => array( 'mc_ptp_pricing_table' ),
	));

		$ptp_plan_group = $main_group->add_field( array(
			'id' => $prefix . 'plan_group',
			'type' => 'group',
			'options' => array(
				'group_title' => 'Plan {#}',
				'add_button' => 'Add another plan',
				'remove_button' => 'Remove plan',
				'sortable' => true,
			),
		));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Plan Header',
				'id' => $prefix . 'head_header',
				'type' => 'title',
				'row_classes' => 'de_hundred de_heading',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Title',
				'id' => $prefix . 'title',
				'type' => 'text',
				'row_classes' => 'de_first de_hundred de_text de_input',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Before Price',
	       	    'id'   => $prefix . 'before_price',
				'type' => 'text',
				'row_classes' => 'de_twentyfive de_text de_input',
				'attributes'  => array(
					'placeholder' => 'e.g. $',
				),
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Price',
	       	    'id'   => $prefix . 'price',
				'type' => 'text',
				'row_classes' => 'de_twentyfive de_text de_input',
				'attributes'  => array(
					'placeholder' => '99',
				),
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'After Price',
	       	    'id'   => $prefix . 'after_price',
				'type' => 'text',
				'row_classes' => 'de_twentyfive de_text de_input',
				'attributes'  => array(
					'placeholder' => 'e.g. .00',
				),
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Caption',
				'id'   => $prefix . 'recurrence',
				'type' => 'text',
				'sanitization_cb' => false,
				'row_classes' => 'de_twentyfive de_text de_input',
				'attributes'  => array(
					'placeholder' => 'e.g. Monthly',
				),
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Plan Features',
				'id' => $prefix . 'features_header',
				'type' => 'title',
				'row_classes' => 'de_hundred de_heading',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Feature list',
				'id' => $prefix . 'features',
				'type' => 'textarea',
				'attributes'  => array(
					'placeholder' => 'one per line',
					'rows' => 13,
				),
				'row_classes' => 'de_first de_fifty de_textarea de_input',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Allowed HTML',
				'desc' => '<span class="dashicons dashicons-yes"></span> Images<br/><span style="color:#bbb;">&lt;img src="/wp-content/uploads/example.png" alt="Alt text"&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Links<br/><span style="color:#bbb;">&lt;a href="http://example.com"&gt;Go to example.com&lt;/a&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Bolded text<br/><span style="color:#bbb;">&lt;strong&gt;Something <strong>important</strong>&lt;/strong&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Emphasized text<br/><span style="color:#bbb;">&lt;em&gt;Something <em>emphasized</em>&lt;/em&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Strikethroughs<br/><span style="color:#bbb;">&lt;del&gt;My feature&lt;/del&gt;</span>',
				'id'   => $prefix . 'features_desc',
				'type' => 'title',
				'row_classes' => 'de_fifty de_info',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Plan Button',
				'id' => $prefix . 'button_header',
				'type' => 'title',
				'row_classes' => 'de_hundred de_heading',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Call to action text',
				'id'   => $prefix . 'btn_text',
				'type' => 'text',
				'attributes'  => array(
					'placeholder' => 'e.g. Purchase',
				),
				'row_classes' => 'de_first de_fifty de_text de_input',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => 'Call to action URL',
	        	'id'   => $prefix . 'btn_link',
	            'type' => 'text',
				'sanitization_cb' => false,
				'attributes'  => array(
				'placeholder' => 'e.g. http://example.com',
				),
				'row_classes' => 'de_fifty de_text de_input',
			));

			$main_group->add_group_field( $ptp_plan_group, array(
				'name' => '',
				'id'   => $prefix . 'sep_header',
				'type' => 'title',
			));
}

add_action( 'cmb2_init', 'mc_ptp_register_plan_group_metabox' );

// Shortcode column
function mc_ptp_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'mc_ptp_shortcode' :
			global $post;
			$slug = '' ;
			$slug = $post->post_name;
			$shortcode = '[ptp name="'.$slug.'"]';
			echo esc_html( $shortcode );
	    break;
	}
}
add_action( 'manage_mc_ptp_pricing_table_posts_custom_column' , 'mc_ptp_custom_columns', 10, 2 );

function mc_ptp_add_admin_columns($columns) {
	return array_merge( $columns, array( 'mc_ptp_shortcode' => __( 'Shortcode' ) ) );
}

add_filter( 'manage_mc_ptp_pricing_table_posts_columns' , 'mc_ptp_add_admin_columns' );

// Display Shortcode
function mc_ptp_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
	), $atts));
	$output2 = '';

	global $post;

	$args = array( 'post_type' => 'mc_ptp_pricing_table', 'name' => $name );
	$custom_posts = get_posts( $args );
	foreach ( $custom_posts as $post ) : setup_postdata( $post );

		$entries = get_post_meta( $post->ID, '_mc_ptp_plan_group', true );

		$nb_entries = count( $entries );;

		// Opening ptp-pricing-table container
		$output2 .= '<div id="ptp-pricing-table" class="ptp-plans ptp-'.$nb_entries .'-plans">';

		// Opening ptp-inner
		$output2 .= '<div class="ptp-inner">';

		foreach ( $entries as $key => $plans ) {

			$output2 .= '<div class="ptp-plan ptp-plan-' . $key . '">';

			// Title
			if ( ! empty( $plans['_mc_ptp_title'] ) ) {
				$output2 .= '<div class="ptp-title ptp-title-' . $key . '">';
				$output2 .= $plans['_mc_ptp_title'];
				$output2 .= '</div>';
			}

			// Head
			$output2 .= '<div class="ptp-head ptp-head-' . $key . '">';

			// Price
			if ( ! empty( $plans['_mc_ptp_price'] ) ) {

				$output2 .= '<div class="ptp-price ptp-price-' . $key . '">';
				
					if ( ! empty( $plans['_mc_ptp_before_price'] ) ) {
						$output2 .= '<span class="ptp-before-price ptp-before-price-' . $key . '">';
						$output2 .= $plans['_mc_ptp_before_price'];
						$output2 .= '</span>';				
					}

				$output2 .= '<span class="ptp-price-inner ptp-price-inner-' . $key . '">';
				$output2 .= $plans['_mc_ptp_price'];
				$output2 .= '</span>';
				
					if ( ! empty( $plans['_mc_ptp_after_price'] ) ) {
						$output2 .= '<span class="ptp-after-price ptp-after-price-' . $key . '">';
						$output2 .= $plans['_mc_ptp_after_price'];
						$output2 .= '</span>';				
					}

				$output2 .= '</div>';
			}

			// Recurrence
			if ( ! empty( $plans['_mc_ptp_recurrence'] ) ) {
				$output2 .= '<div class="ptp-recurrence ptp-recurrence_' . $key . '">' . $plans['_mc_ptp_recurrence'] . '</div>';
			}

			// Closing plan head
			$output2 .= '</div>';

			if ( ! empty( $plans['_mc_ptp_features'] ) ) {

				$output2 .= '<div class="ptp-features ptp-features-' . $key . '">';

				$string = $plans['_mc_ptp_features'];
				$stringAr = explode( "\n", $string );
				$stringAr = array_filter( $stringAr, 'trim' );

				$features = '';

				foreach ( $stringAr as $feature ) {
					$features[] .= strip_tags( $feature,'<strong></strong><br><br/></br><img><a><del><em>' );
				}

				foreach ( $features as $small_key => $feature ) {
					if ( ! empty( $feature ) ) {

						$output2 .= '<div class="ptp-feature ptp-feature-' . $key . '-' . $small_key . '">';
						$output2 .= $feature;
						$output2 .= '</div>';

					}
				}

				$output2 .= '</div>';
			}

			if ( ! empty( $plans['_mc_ptp_btn_text'] ) ) {
				$btn_text = $plans['_mc_ptp_btn_text'];
				if ( ! empty( $plans['_mc_ptp_btn_link'] ) ) {
					$btn_link = $plans['_mc_ptp_btn_link'];
				} else { $btn_link = '#'; }
			} else {
				$btn_text = '';
				$btn_link = '#';
			}

				  // Default footer
			if ( ! empty( $plans['_mc_ptp_btn_text'] ) ) {
				$output2 .= '<a href="' . do_shortcode( $btn_link ) . '" class="ptp-foot ptp-foot-' . $key . '">';
			} else {
				$output2 .= '<a class="ptp-foot ptp-foot-' . $key . '">';
			}

				$output2 .= do_shortcode( $btn_text );

				  // Closing default footer
				  $output2 .= '</a>';

			$output2 .= '</div>';

		}

		// Closing ptp inner
		$output2 .= '</div>';

		// Closing ptp container
		$output2 .= '</div>';

	endforeach; wp_reset_postdata();
	return $output2;

}

add_shortcode( 'ptp', 'mc_ptp_shortcode' );
?>
