<?php
/**
 * Plugin Name: Shift8 Modal
 * Plugin URI: https://github.com/stardothosting/shift8-modal 
 * Description: This plugin incorporates animatedModal.js into easy-to-use shortcode
 * Version: 1.3
 * Author: Shift8 Web 
 * Author URI: https://www.shift8web.ca
 * License: GPLv3
 */

// Load Animated Modal
function shift8_modal_scripts() {
	wp_enqueue_script( 'animate-js', plugin_dir_url( __FILE__ ) . 'js/animatedModal.min.js', array(), true );
	wp_enqueue_style( 'animate', plugin_dir_url( __FILE__ ) . 'css/animate.min.css' );
}
add_action( 'wp_enqueue_scripts', 'shift8_modal_scripts', 12 );


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
	if (empty($post_id) || !is_numeric($post_id)) {
		return 'You must enter a post ID number for the shortcode to work!';
	}

	if ( FALSE === get_post_status($post_id)) {
		return 'The post ID you entered isn\'t valid!';
	} else {
		// Clean vars
		$call_modal = esc_html($call_modal);
		$close_modal = esc_html($close_modal);
		$animatedIn = esc_js($animatedIn);
		$animatedOut = esc_js($animatedOut);
		$color = esc_html($color);
		
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
            $modal_output .=  '<div id="shift8modal-'.$post_id.'" class="shift8modal-container shift8modal-container-'.$post_id.'" style="display:none;">
                            <div id="shift8-close-modal" class="close-shift8modal close-shift8modal-'.$post_id.'">
                                '.$close_modal.'
                            </div>
                            <div class="shift8-modal-content shift8-modal-content-'.$post_id.'">
                                    '.do_shortcode($modal_content->post_content).'
                            </div>
                        </div>';
            $modal_output .= '<script type="text/javascript">
                            jQuery( document ).ready(function() {
                                jQuery("#shift8-modal-'.$post_id.'").animatedModal({
                                    beforeOpen: function() {
                                        jQuery(".shift8modal-container-'.$post_id.'").show();
                                    },
                                    modalTarget: \'shift8modal-'.$post_id.'\',
                                    animatedIn: \''.$animatedIn.'\',
                                    animatedOut: \''.$animatedOut.'\',
                                    color: \''.$color.'\',
                                });
                                jQuery(".close-shift8modal-'.$post_id.'").click(function() {
                                    jQuery(".shift8modal-container-'.$post_id.'").hide();
                                });
                            });
                        </script>';
		return $modal_output;
    }

}

add_shortcode('shift8_modal', 'shift8_modal_shortcode');
