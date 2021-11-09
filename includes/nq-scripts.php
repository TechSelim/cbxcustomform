<?php 

class Nq_Scripts{

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'cbxcf-scripts' => [
                'src'     => CBXCF_ASSETS . '/js/scripts.js',
                'version' => filemtime( CBXCF_PATH . '/assets/js/scripts.js' ),
                'deps'    => [ 'jquery' ]
            ]
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles() {
        return [
            'cbxcf-style' => [
                'src'     => CBXCF_ASSETS . '/css/style.css',
                'version' => filemtime( CBXCF_PATH . '/assets/css/style.css' )
            ]
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets() {

        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }

        wp_localize_script( 'cbxcf-scripts', 'cbxcfObj', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong', 'cbxcustomform' ),
        ] );

    }    

}