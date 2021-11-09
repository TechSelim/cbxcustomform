<?php
/**
 * Shortcode handler class
 */
class CBXCF_Shortcode {

    /**
     * Initializes the class
     */
    function __construct() {
        add_shortcode( 'cbxcustomform', [ $this, 'cb_shortcode' ] );
    }

    /**
     * Shortcode callback function
     * @return string
     */
    public function cb_shortcode( $atts, $content = '' ) {
        wp_enqueue_style( 'cbxcf-style' );
        
        if ( !is_user_logged_in() ) {
            $redirect_url = get_permalink();
            $form = wp_login_form(array( 'echo' => false, 'redirect' => $redirect_url ) );

            return $form;
        }else {
            wp_enqueue_script( 'cbxcf-scripts' );
            
            ob_start();
    
            include __DIR__ . '/views/form.php';
    
            return ob_get_clean();
        }

    }
}
