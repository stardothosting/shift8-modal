<?php
/**
 * Plugin Name: Shift8 Modal
 * Plugin URI: https://github.com/stardothosting/shift8-modal 
 * Description: This plugin incorporates animatedModal.js into easy-to-use shortcode
 * Version: 1.0.0
 * Author: Shift8 Web 
 * Author URI: https://www.shift8web.ca
 * License: MIT
 */

// Load Animated Modal
function shift8_modal_scripts() {
	wp_enqueue_script( 'animate-js', plugin_dir_url( __FILE__ ) . 'js/animatedModal.min.js', array(), true );
	wp_enqueue_style( 'animate', plugin_dir_url( __FILE__ ) . 'css/animate.min.css' );
}
add_action( 'wp_enqueue_scripts', 'shift8_modal_scripts', 12,1 );


// Shortcode for menu overlay system
function shift8_modal_shortcode($atts){
	// Set shortcode options
	extract(shortcode_atts(array(
		'post_id' => '',
		'close_modal' => 'CLOSE MODAL',
		'call_modal' => 'DEMO',
		'call_type' => 'button',
		'animatedIn' => 'lightSpeedIn',
		'animatedOut' => 'bounceOutDown',
		'color' => '#3498db',
		'title' => 'Overlay Modal'
	), $atts));

	// Cant proceed without post_id
	if (empty($post_id)) {
		return 'You must enter a post ID for the shortcode to work!';
	}

	if ( FALSE === get_post_status($post_id)) {
		return 'The post ID you entered isn\'t valid!';
	} else {
		// Clean vars
		$post_id = esc_attr($post_id);
		$call_modal = esc_attr($call_modal);
		$close_modal = esc_attr($close_modal);
		$animatedIn = esc_attr($animatedIn);
		$animatedOut = esc_attr($animatedOut);
		$color = esc_attr($color);
		
		// Set the trigger as button or plain text
		if (strcasecmp($call_type, 'button') == 0) {
			$close_modal_output = '<button class="shift8-modal-button" id="shift8-modal-'.$post_id.'" href="#shift8modal-'.$post_id.'">'.$call_modal.'</button>';
		} else {
			$close_modal_output = '<a class="shift8-modal-button" id="shift8-modal-'.$post_id.'" href="#shift8modal-'.$post_id.'">'.$call_modal.'</a>';
		}
			
		// Grab content from post id
	        $modal_content = get_post($post_id, $filter = 'display');

		// Prepare output
	        $modal_output = $close_modal_output;
	        $modal_output .=  '<div id="shift8modal-'.$post_id.'">
                            <div id="shift8-close-modal" class="close-shift8modal close-shift8modal-'.$post_id.'">
                                '.$close_modal.'
                            </div>
                            <div class="shift8-modal-content shift8-modal-content-'.$post_id.'">
                                    '.$modal_content->post_content.'
                            </div>
                        </div>';
	        $modal_output .= '<script type="text/javascript">
                            jQuery("#shift8-modal-'.$post_id.'").animatedModal({
                                modalTarget: \'shift8modal-'.$post_id.'\',
                                animatedIn: \''.$animatedIn.'\',
                                animatedOut: \''.$animatedOut.'\',
                                color: \''.$color.'\'
                            });
                        </script>';
		return $modal_output;
    }

}

add_shortcode('shift8_modal', 'shift8_modal_shortcode');
