<?php
/**
 * Theme Functions 
 */
 
// Enqueue jquery
function add_custom_jquery() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tabs');	
	wp_enqueue_script('jquery-effects-core');
	wp_enqueue_style('plugin-styles', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/plugins.css', false, null,'all');
	wp_enqueue_style('skeleton-framework', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/framework.css', false, null,'all');
	wp_enqueue_style('bootstrap-nav', '//cms.georgiasouthern.edu/~gsu/web_templates/bootstrap/css/nav.css', false, null,'all');
	wp_enqueue_style('global-nav', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/wp/global-nav.css', false, null,'all');
	wp_enqueue_style('global-styles', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/wp/styles.min.css', false, null,'all');
	wp_enqueue_style('responsive-styles', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/wp/responsive.min.css', false, null,'all');
	wp_enqueue_style('print-styles', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/wp/print.min.css', false, null,'print');
	wp_enqueue_style('local-styles', get_template_directory_uri() . '/style.css', false, null,'all');
	wp_enqueue_style('responsive-dept', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/css/wp/responsive-dept.css', false, null,'all');	
	wp_enqueue_script('bootstrap-navjs', '//cms.georgiasouthern.edu/~gsu/web_templates/bootstrap/js/nav.js', array( 'jquery' ), null, true);
	wp_enqueue_script('plugins', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/js/plugins.js', array( 'jquery' ), null, true);
	wp_enqueue_script('custom-scripts', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/js/custom-ui-scripts.js', array( 'jquery' ), null, true);
	wp_enqueue_script('lightbox', '//cms.georgiasouthern.edu/~gsu/web_templates/CORE/js/plugin-lightbox.min.js', array( 'jquery' ), null, true);	
}
add_action('wp_enqueue_scripts', 'add_custom_jquery');

// Remove wp version, api, xmlrpc and wlwmanifest links in meta
remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// On login screen, replaces WP logo with Georgia Southern logo
add_action("login_head", "custom_login_logo");

function custom_login_logo() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('https://cms.georgiasouthern.edu/~gsu/web_templates/CORE/images/wpthemes/wplogin-gsu-logo.png') no-repeat scroll center top transparent;
		height: 200px;
		width: 200px;
		margin: 0 auto;
	}	
	</style>
	";
}

// Add Pages, Remove News Access for Author Role
function gsu_author_caps() {
$role = get_role( 'author' );
$role->add_cap( 'unfiltered_html' );  
$role->add_cap( 'edit_pages' );
$role->add_cap( 'publish_pages' );
$role->add_cap( 'edit_published_pages' );
$role->add_cap( 'delete_published_pages' );
$role->remove_cap( 'edit_posts' );
$role->remove_cap( 'edit_published_posts' ); 
$role->remove_cap( 'publish_posts' ); 
$role->remove_cap( 'delete_published_posts' );
$role->remove_cap( 'delete_posts' ); 
}
add_action( 'admin_menu', 'gsu_author_caps');

//Add Media Library and additional Posts capabilities to Contributor Role
function gsu_contributor_caps() {
$role = get_role( 'contributor' );
$role->add_cap( 'unfiltered_html' ); 
$role->add_cap( 'edit_others_posts' );
$role->add_cap( 'edit_published_posts' ); 
$role->add_cap( 'upload_files' ); 
$role->add_cap( 'publish_posts' ); 
$role->add_cap( 'delete_published_posts' );
$role->add_cap( 'manage_categories' );
}
add_action( 'admin_menu', 'gsu_contributor_caps');

// Restrict Site Admin Access
function gsu_admin_caps() {
$role = get_role( 'administrator' );
$role->add_cap( 'unfiltered_html' );   
$role->remove_cap( 'activate_plugins' );
$role->remove_cap( 'delete_plugins' );
$role->remove_cap( 'delete_themes' );
$role->remove_cap( 'edit_plugins' );
$role->remove_cap( 'edit_themes' );
$role->remove_cap( 'edit_users' );
$role->remove_cap( 'import' );
$role->remove_cap( 'install_plugins' );
$role->remove_cap( 'install_themes' );
$role->remove_cap( 'manage_sites' );
$role->remove_cap( 'manage_options' );
$role->remove_cap( 'promote_users' );
$role->remove_cap( 'remove_users' );
$role->remove_cap( 'switch_themes' );
$role->remove_cap( 'update_core' );
$role->remove_cap( 'update_plugins' );
$role->remove_cap( 'update_themes' );
}
add_action( 'admin_menu', 'gsu_admin_caps');

// Remove News from menu for Authors
function remove_adminmenus_for_author() {
	global $menu;
	if(!current_user_can( 'edit_posts' )) {	
	remove_menu_page( 'edit.php' );
	}
}
add_action( 'admin_menu', 'remove_adminmenus_for_author' );

// Register nav menus
add_action('init', 'register_custom_menu');
 
function register_custom_menu() {
register_nav_menu('department_navigation', 'Primary Navigation');
}

// Add Custom Header support
function custom_header_support() {
$args = array(
	'width'         => 940,
	'height'        => 265,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'custom_header_support' );

// Register Sidebars
add_action( 'widgets_init' , 'register_custom_sidebars' );

function register_custom_sidebars() {
register_sidebar(array(
  'name' => __( 'Right Sidebar' ),
  'id' => 'right-sidebar',
  'description' => __( 'Widgets in this area will be shown in the right sidebar on all pages.' ),
  'before_widget' => '<div class="sidebar-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6 class="ribbon-right"><span>',
  'after_title' => '</span></h6><div class="ribbon-right-corner"></div>'
));

register_sidebar(array(
  'name' => __( 'Footer' ),
  'id' => 'dept-footer',
  'description' => __( 'Footer content.' ),
  'before_widget' => '',
  'after_widget'  => '',
  'before_title' => '',
  'after_title' => ''
));

register_sidebar(array(
  'name' => __( 'Home Bottom Left' ),
  'id' => 'home-bottom-left',
  'description' => __( 'Optional - Widget will display when the Page with 3 Bottom Widgets template is used.' ),
  'before_widget' => '<div class="bottom-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6>',
  'after_title' => '</h6>'
));

register_sidebar(array(
  'name' => __( 'Home Bottom Middle' ),
  'id' => 'home-bottom-middle',
  'description' => __( 'Optional - Widget will display when the Page with 3 Bottom Widgets template is used.' ),
  'before_widget' => '<div class="bottom-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6>',
  'after_title' => '</h6>'
));

register_sidebar(array(
  'name' => __( 'Home Bottom Right' ),
  'id' => 'home-bottom-right',
  'description' => __( 'Optional - Widget will display when the Page with 3 Bottom Widgets template is used.' ),
  'before_widget' => '<div class="bottom-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6>',
  'after_title' => '</h6>'
));
}

// Custom WordPress Admin Footer
function remove_footer_admin () {
	echo 'Theme Copyright &copy; Marketing &amp; Communications and Information Technology Services Web Team, Georgia Southern University';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Customize wp admin bar
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('about');
	$wp_admin_bar->remove_menu('wporg');
	$wp_admin_bar->remove_menu('documentation');
	$wp_admin_bar->remove_menu('support-forums');
	$wp_admin_bar->remove_menu('feedback');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('new-link');
	$wp_admin_bar->remove_menu('new-user');
	$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('w3tc');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// Customize tinymce editor
function customize_mce_buttons($init) {
	$init['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,alignjustify,link,unlink,wp_more,spellchecker,fullscreen,wp_adv';
	$init['toolbar2'] = 'formatselect,pastetext,removeformat,charmap,superscript,subscript,outdent,indent,undo,redo,table,wp_help';
	$init['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6";
	return $init;
}
add_filter('tiny_mce_before_init', 'customize_mce_buttons');

// REMOVE LINKS, COMMENTS FROM ADMIN PANEL
function gsudept_remove_menu_pages() {		
		remove_menu_page('edit-comments.php');
		remove_menu_page('link-manager.php');		
		//remove_menu_page('users.php');
		//remove_menu_page('options-writing.php');
		//remove_menu_page('options-reading.php');
		//remove_menu_page('options-discussion.php');
		//remove_menu_page('options-privacy.php');
		//remove_menu_page('options-permalinks.php');
		//remove_menu_page('import.php');
		//remove_menu_page('upload.php');
		//remove_menu_page('tools.php');
		//remove_menu_page('options-general.php');
	}
add_action( 'admin_menu', 'gsudept_remove_menu_pages' );

// Removes unnecessary widgets from Appearance-->Widgets menu
function remove_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Tag_Cloud');
	//unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	//unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Links');
	}
add_action('widgets_init','remove_wp_widgets', 1);
remove_action( 'widgets_init', 'akismet_register_widgets' );

// ADD CUSTOM OPTIONS TO GENERAL SETTINGS PANEL
$new_general_setting = new new_general_setting();
 
class new_general_setting {
    function __construct( ) {
        add_filter( 'admin_menu' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'parent_college', 'esc_attr' );
        add_settings_field('parent_college', '<label for="parent_college">'.__('College' , 'parent_college' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'parent_college', '' );
        echo '<input type="text" id="parent_college" name="parent_college" value="' . $value . '" />';
    }
}

 // CHANGE POSTS TO NEWS
function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';	
	echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
}
add_action( 'init', 'change_post_object_label' );
    
// CUSTOM SHORTCODES
function floatlist_shortcode( $atts, $content = null ) {
   return '<div class="floatleft">' . $content . '</div>';
}
add_shortcode( 'floatlist', 'floatlist_shortcode' );

function accordion_heading_shortcode( $atts, $content = null ) {
   return '<h6 class="btn_toggle">' . $content . '</h6>';
}
add_shortcode( 'accordion_heading', 'accordion_heading_shortcode' );

function accordion_content_shortcode( $atts, $content = null ) {
   return '<div class="slide_toggle">' . $content . '</div>';
}
add_shortcode( 'accordion_content', 'accordion_content_shortcode' );

function gsuslideshow_shortcode( $atts, $content = null ) {
   return '<div id="cycle">' . $content . '</div>';
}
add_shortcode( 'gsuslideshow', 'gsuslideshow_shortcode' );

function gstestimonial_shortcode( $atts, $content = null ) {
   return '<div class="testimonial"><p>' . do_shortcode($content) . '</p></div>';
}
add_shortcode( 'testimonial', 'gstestimonial_shortcode' );

function gstestimonial_author_shortcode( $atts, $content = null ) {
   return '<span class="author">' . $content . '</span>';
}
add_shortcode( 'author', 'gstestimonial_author_shortcode' );

add_filter('widget_text', 'do_shortcode'); //enable shortcode use in sidebar widgets

// remove version info from head and feeds
add_filter('the_generator', 'digwp_complete_version_removal');
function digwp_complete_version_removal() {
    return '';
}

// clear rss widget cache every 15 mins
//add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 900;' ) );
add_action('wp_feed_cache_transient_lifetime', function(){
		return 900;
	});

// 3/30/16 - RHickey, fix to resolve issue introduced in WP 4.4.2 with URL used for img srcset attributes
// In SSL, force URLs in srcset attributes to use https. 
// This prevents mixed content errors when displaying content on secure sites, i.e., on MyGS or when users are logged in to WordPress admin. 

function ssl_srcset( $sources ) {
  if(is_ssl()) {
	  foreach ( $sources as &$source ) {
		$source['url'] = set_url_scheme( $source['url'], 'https' );
	}
  }
  return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );
?>