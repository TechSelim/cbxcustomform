<?php 

/**
 * Ajax handler class
 */
class Form_Handler {

    /**
     * Class constructor
     */
    function __construct() {

        add_action( 'wp_ajax_cbxcf_form', [ $this, 'submit_form'] );
        add_action( 'wp_ajax_nopriv_cbxcf_form', [ $this, 'submit_form'] );
    }

    /**
     * Handle Enquiry Submission
     *
     * @return void
     */
    public function submit_form() {

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'cbxcf-form-nonce' ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'cbxcustomform' )
            ] );
        }

        $title          = sanitize_text_field($_POST['title']);
        $description    = sanitize_text_field($_POST['description']);
        $singer         = sanitize_text_field($_POST['singer']);
        $cbx_post_id    = false;
        
		if( $title != '' && $description != '' ){
			$cbx = array(
			   'post_type'     => 'cbxcustom',
			   'post_title'    => $title,
			   'post_content'  => $description,
			   'post_status'   => 'publish'
			 );

			$cbx_post_id = wp_insert_post( $cbx );
		} 

        if( $cbx_post_id ){

            if( $singer != '' ){
                update_post_meta( $cbx_post_id, '_cbxcustomform_singer', $singer );
            }

            /**
             * Update usermeta
            */
            $user_id = get_current_user_id();

            if( $user_id != 0 ) {
                $cbxcustomform_count = ( get_user_meta( $user_id, '_cbxcustomform_count', true ) && get_user_meta( $user_id, '_cbxcustomform_count', true ) != '' ) ? ( int )get_user_meta( $user_id, '_cbxcustomform_count', true ) : 0;
                $cbxcustomform_count++;
                update_user_meta( $user_id, '_cbxcustomform_count', $cbxcustomform_count );
            }

            /**
             * Send success
            */
            $cbxcf_count = (int)get_user_meta( $user_id, '_cbxcustomform_count', true );
            wp_send_json_success([
                'cbxcf_count' => $cbxcf_count,
                'message' => __( 'Data updated successfully!', 'cbxcustomform' )
            ]);

        }else{
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'cbxcustomform' )
            ] );
        }

    }

}