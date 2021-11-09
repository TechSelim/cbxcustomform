<?php 
/**
 * Class for custom post types
*/
class CBXCustom_Posts{

    /**
     * Constructor
     */
    function __construct() {
        add_action( 'init', [$this, 'cbxcf_register_custom_post'] );
    }
    
    /**
     * 
     * Register custom post
    */
    public function cbxcf_register_custom_post(){

        $labels = array(
                'name'               => _x( 'CBXCustom', 'CBXCustom' ),
                'singular_name'      => _x( 'CBXCustom', 'CBXCustom' ),
                'add_new'            => _x( 'Add New', 'CBXCustom' ),
                'add_new_item'       => __( 'Add New CBXCustom' ),
                'edit_item'          => __( 'Edit CBXCustom' ),
                'new_item'           => __( 'New CBXCustom' ),
                'all_items'          => __( 'All CBXCustom' ),
                'view_item'          => __( 'View CBXCustom' ),
                'search_items'       => __( 'Search CBXCustom' ),
                'not_found'          => __( 'No CBXCustom found' ),
                'not_found_in_trash' => __( 'No CBXCustom found in the Trash' ), 
                'parent_item_colon'  => __( 'Parent CBXCustom' ),
                'menu_name'          => 'CBXCustom'
            
            );

        $args = array(
            'labels'                => $labels,
            'description'           => 'CBXCustom Posts',
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
            'can_export'            => true,
            'menu_position'         => 5,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'supports'              => array( 'title', 'editor' ),
            'has_archive'           => false
        );

        register_post_type( 'cbxcustom', $args );

    }
}