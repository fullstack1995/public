<?php defined( 'ABSPATH' ) or die;

/**
 * Loads a plugin's translated strings.
 */
add_action( 'plugins_loaded', function()
{
    $mofile = get_locale() . '.mo';

    load_textdomain( 'infojob', INFOJOB_DIRECTORY . 'languages/' . $mofile );
} );

/**
 * Fires when scripts and styles are enqueued.
 */
add_action( 'wp_enqueue_scripts', function()
{
    // styles
    wp_enqueue_style( 'select2', INFOJOB_URL . 'assets/vendors/css/select2.min.css', [], INFOJOB_VERSION );

    wp_enqueue_style( 'infojob', INFOJOB_URL . 'assets/frontend/css/default.css', ['select2'], INFOJOB_VERSION );

    // scripts
    wp_enqueue_script( 'select2', INFOJOB_URL . 'assets/vendors/js/select2.min.js', [ 'jquery' ], INFOJOB_VERSION );

    wp_enqueue_script( 'infojob', INFOJOB_URL . 'assets/frontend/js/default.js', [ 'select2' ], INFOJOB_VERSION );

    wp_localize_script( 'infojob', 'infojob', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ] );
} );

add_action( 'init', function()
{
    register_post_type( 'advertising', [
        'labels' => [
            'name' => __( 'Advertisings', 'infojob' ),
            'singular_name' => __( 'Advertising', 'infojob' ),
            'add_new' => __( 'Add new', 'infojob' ),
            'add_new_item' => __( 'Add new advertising', 'infojob' ),
            'edit_item' => __( 'Edit advertising', 'infojob' ),
            'new_item' => __( 'New advertising', 'infojob' ),
            'view_item' => __( 'View advertising', 'infojob' ),
            'search_items' => __( 'Search advertisings', 'infojob' ),
        ],
        'capability_type' => 'post',
        'supports' => [ 'title', 'editor', 'thumbnail' ],
        'public' => true,
        'menu_position' => 10,
        'show_ui' => true,
        'show_in_menu' => true, // true, false, edit.php?post_type=page
        'menu_icon' => 'dashicons-networking',
    ] );

    $taxonomies = [
        'job' => [
            'hierarchical' => true,
            'labels' => [
                'menu_name' => __( 'Categories', 'infojob' ),
                'name' => __( 'Categories', 'infojob' ),
                'singular_name' => __( 'Search categories', 'infojob' ),
                'search_items' => __( 'Search categories', 'infojob' ),
                'all_items' => __( 'All categories', 'infojob' ),
                'parent_item' => __( 'Parent category', 'infojob' ),
                'parent_item_colon' => __( 'Parent category:', 'infojob' ),
                'edit_item' => __( 'Edit category', 'infojob' ),
                'update_item' => __( 'Update category', 'infojob' ),
                'add_new_item' => __( 'Add New category', 'infojob' ),
                'new_item_name' => __( 'New category Name', 'infojob' ),
            ],
        ],
        'list' => [
            'hierarchical' => false,
            'labels' => [
                'menu_name' => __( 'Tags', 'infojob' ),
                'name' => __( 'Tags', 'infojob' ),
                'singular_name' => __( 'Search tags', 'infojob' ),
                'search_items' => __( 'Search tags', 'infojob' ),
                'all_items' => __( 'All tags', 'infojob' ),
                'parent_item' => __( 'Parent tag', 'infojob' ),
                'parent_item_colon' => __( 'Parent tag:', 'infojob' ),
                'edit_item' => __( 'Edit tag', 'infojob' ),
                'update_item' => __( 'Update tag', 'infojob' ),
                'add_new_item' => __( 'Add New tag', 'infojob' ),
                'new_item_name' => __( 'New tag Name', 'infojob' ),
            ],
        ],
        'location' => [
            'hierarchical' => true,
            'labels' => [
                'menu_name' => __( 'Locations', 'infojob' ),
                'name' => __( 'Locations', 'infojob' ),
                'singular_name' => __( 'Search locations', 'infojob' ),
                'search_items' => __( 'Search locations', 'infojob' ),
                'all_items' => __( 'All locations', 'infojob' ),
                'parent_item' => __( 'Parent location', 'infojob' ),
                'parent_item_colon' => __( 'Parent location:', 'infojob' ),
                'edit_item' => __( 'Edit location', 'infojob' ),
                'update_item' => __( 'Update location', 'infojob' ),
                'add_new_item' => __( 'Add New location', 'infojob' ),
                'new_item_name' => __( 'New location Name', 'infojob' ),
            ],
        ],
    ];

    foreach( $taxonomies as $name => $options )
    {
        register_taxonomy( $name, 'advertising', $options );
    }
} );

add_filter( 'TieLabs/settings_post_types', function( $post_types )
{
    $post_types[] = 'advertising';

    return $post_types;
} );

add_filter( 'TieLabs/Settings/default_post_types', function( $post_types )
{
    $post_types[] = 'advertising';

    return $post_types;
} );

add_action( 'save_post_advertising', function( $post_id )
{
    if( wp_is_post_revision( $post_id ) || !isset( $_POST['post_title'] ) )
    {
        return;
    }

    update_post_meta( $post_id, 'municipality_regional', $_POST['municipality_regional'] );
    update_post_meta( $post_id, 'district', $_POST['district'] );
    update_post_meta( $post_id, 'street', $_POST['street'] );
    update_post_meta( $post_id, 'building', $_POST['building'] );
    update_post_meta( $post_id, 'address', $_POST['address'] );
    update_post_meta( $post_id, 'website', $_POST['website'] );
    update_post_meta( $post_id, 'phone1', $_POST['phone1'] );
    update_post_meta( $post_id, 'phone2', $_POST['phone2'] );
    update_post_meta( $post_id, 'phone3', $_POST['phone3'] );
    update_post_meta( $post_id, 'fax', $_POST['fax'] );
    update_post_meta( $post_id, 'cellphone1', $_POST['cellphone1'] );
    update_post_meta( $post_id, 'cellphone2', $_POST['cellphone2'] );
    update_post_meta( $post_id, 'email', $_POST['email'] );
    update_post_meta( $post_id, 'google_map', $_POST['google_map'] );
    update_post_meta( $post_id, 'video', $_POST['video'] );
} );

add_action( 'add_meta_boxes', function()
{
    add_meta_box(
        'information',
        __( 'Information', 'infojob' ),
        'advertising_metabox',
        'advertising',
    );
} );

function advertising_metabox( $post ): void
{
    include INFOJOB_TEMPLATES . 'hooks/add_meta_boxes/information.php';
}

add_filter( 'single_template', function( $single_template )
{
    global $post;

    if( $post->post_type == 'advertising' && class_exists( 'TIELABS_HELPER' ) )
    {
        $single_template = INFOJOB_TEMPLATES . '/frontend/infojob.php';
    }

    return $single_template;
} );

//add_action( 'TieLabs/before_main_content', function()
add_action( 'TieLabs/main_content_row/before', function()
{
    echo do_shortcode( '[infojob-search-form]' );
} );

add_action( 'TieLabs/after_post_content', function()
{
    if( !is_singular( 'advertising' ) )
    {
        return;
    }

    $style = tie_get_option( 'post_tags_layout', 'modern' );

    echo get_the_term_list( get_the_id(), 'list', '<div class="post-bottom-meta post-bottom-tags post-tags-' . $style . '"><div class="post-bottom-meta-title"><span class="tie-icon-tags" aria-hidden="true"></span></div><span class="tagcloud">', ' ', '</span></div>' );

//    include INFOJOB_TEMPLATES . 'hooks/TieLabs/after_post_content.php';
} );

class Advertising_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'advertising-information',
            __( 'Advertising information', 'infojob' ),
            ['description' => '']
        );
    }

    public function widget( $args, $instance ): void
    {
        if( !is_singular( 'advertising' ) )
        {
            return;
        }

        echo $args['before_widget'];

        include INFOJOB_TEMPLATES . 'hooks/widgets/advertising-information.php';

        echo $args['after_widget'];
    }
}

add_action( 'widgets_init', function()
{
    register_widget( 'Advertising_Widget' );
} );
