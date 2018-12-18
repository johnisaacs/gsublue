<?php 
add_action( 'admin_menu', 'dept_contact_menu' );

function dept_contact_menu() {
	add_pages_page( 'Dept Contact Info', 'Dept Contact Info', 'manage_options', 'dept-contact-info', 'dept_contact_options' );
}
 
    function register_fields() {
        register_setting( 'general', 'dept_info', 'esc_attr' );
        add_settings_field('dept_info', '<label for="dept_info">'.__('Department Address' , 'dept_info' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'dept_info', '' );
        echo '<input type="text" id="dept_info" name="dept_info" value="' . $value . '" />';
    }
}