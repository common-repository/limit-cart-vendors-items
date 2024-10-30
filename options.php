<?php
class Limit_Cart_Vendor_Items {
    // Our code will go here
    
    public function __construct() {
    // Hook into the admin menu
    add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
    add_action( 'admin_init', array( $this, 'setup_sections' ) );
    add_action( 'admin_init', array( $this, 'setup_fields' ) );
    add_action( 'admin_init', array( $this, 'field_callback' ) );
}
    public function create_plugin_settings_page() {
    // Add the menu item and page
    $page_title = 'Limit Cart Vendor Items';
    $menu_title = 'Limit Cart options';
    $capability = 'manage_options';
    $slug = 'limit_vendor_items';
    $callback = array( $this, 'plugin_settings_page_content' );
    

    add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
}
    
    public function plugin_settings_page_content() { ?>
    <div class="wrap">
        <h2>Limit Cart Vendor & Items Settings</h2>
        <b><p style="color:#1556f8">Specify the maximum vendors/items that a customer can buy per order.</></b>
        <b><p style="color:#3412f6">The default setting is 50 vendors and 10,000 items per order.</p></b>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'limit_vendor_items' );
                do_settings_sections( 'limit_vendor_items' );
                submit_button();
            ?>
        </form>
    </div> <?php
}
public function setup_sections() {
    add_settings_section( 'our_first_section', 'Vendor items settings', array( $this, 'section_callback' ), 'limit_vendor_items' );
    
}

public function section_callback( $arguments ) {
    switch( $arguments['type'] ){
    case 'number': // If it is a number field
        printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" min="%5$s" max="%6$s" />', 
        $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value, $arguments['min'],$arguments['max']);
        break;
    
}

}
public function setup_fields() {
    $fields = array(
    array(
        'uid' => 'vendor_number',
        'label' => 'Vendor Number',
        'section' => 'our_first_section',
        'type' => 'number',
        'min'  => '1',
        'max' => '50',
        'options' => false,
        'placeholder' => 'cart vendors',
        'default' => '50'
    ),
    
    array(
        'uid' => 'total_items',
        'label' => 'Total items',
        'section' => 'our_first_section',
        'type' => 'number',
        'min'  => '1',
        'max' => '10000',
        'options' => false,
        'placeholder' => '# of items',
        'default' => '10000'
    )
);
    foreach( $fields as $field ){
        add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'limit_vendor_items', $field['section'], $field );
        register_setting( 'limit_vendor_items', $field['uid'] );
    }
}


public function field_callback( $arguments ) {
    global $value;
    $value = get_option( $arguments['uid'] ); // Get the current value, if there is one
    if( ! $value ) { // If no value exists
        $value = $arguments['default']; // Set to our default
    }

    // Check which type of field we want
    switch( $arguments['type'] ){
    case 'number': // If it is a text field
        printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" min="%5$s" max="%6$s" />', 
        $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value, $arguments['min'],$arguments['max'] );
        break;
    
}


    // If there is help text
    if( $helper = $arguments['helper'] ){
        printf( '<span class="helper"> %s</span>', $helper ); // Show it
    }

    // If there is supplemental text
    if( $supplimental = $arguments['supplemental'] ){
        printf( '<p class="description">%s</p>', $supplimental ); // Show it
    }
}
    
    
    
    
    
}

if( is_admin() )
$limit_cart_vendor_items = new Limit_Cart_Vendor_Items();

?>