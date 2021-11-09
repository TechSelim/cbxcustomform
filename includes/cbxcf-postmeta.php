<?php 
/**
 * CBXCF custom meta class
*/
class CBXCF_Postmeta {

    /**
     * Class constructor
    */
    function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'add_cbxcustomform_metabox' ] );
        add_action( 'save_post', [ $this, 'save_custom_metabox' ] );
        add_filter( 'the_content', [ $this, 'add_singer_name' ]);
    }

    /**
     * add meta box
    */
    public function add_cbxcustomform_metabox() {
        add_meta_box( '_cbxcustomform_singer', __( 'Singer', 'cbxcustomform' ), [ $this, 'add_cbxcustomform_metabox_cb' ], 'cbxcustom' );
    }
    
    /**
     * display input box callback
    */
    public function add_cbxcustomform_metabox_cb( $post ) {
        wp_nonce_field( 'singer_nonce', 'singer_nonce' );

        $value = get_post_meta( $post->ID, '_cbxcustomform_singer', true );

        echo "<input  type='text' name='singer' value='" . $value . "' >";
    }

    /**
     * function add singer name
     * @param $content
     * @return content
    */
    public function add_singer_name( $content ) {
        global $post;

        if( $post->post_type == 'cbxcustom' ) {
            $singer = "<div class='singer'>" . "<label>" .  __('Singer: ', 'cbxcustomform') . "</label>" . get_post_meta( get_the_ID(), '_cbxcustomform_singer' )[0] . "</div>";
            return $content .= $singer;
        }else {
            return $content;
        }

    
    }

    /**
     * Save custom meta box callback
    */
    function save_custom_metabox( $post_id ) {
        /**
         * check nonce field is set
        */
        if ( ! isset( $_POST['singer_nonce'] ) && ! isset( $_POST['singer'] ) ) {
            return;
        }
        
        /**
         * Verify that the nonce is valid.
        */
        if ( ! wp_verify_nonce( $_POST['singer_nonce'], 'singer_nonce' ) ) {
            return;
        }
        
        $singer = sanitize_text_field( $_POST['singer'] );

        update_post_meta( $post_id, '_cbxcustomform_singer', $singer );

    }

}