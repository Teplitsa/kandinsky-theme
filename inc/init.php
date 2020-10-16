<?php
/**
 * Theme functions init
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Teplitsa
 * @subpackage Kandinsky
 * @since Kandinsky 2.0.0
 */

/**
 * Theme Init
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Scripts
 */
require get_template_directory() . '/inc/scripts.php';



function kandinsky_disable_wp_emojicons() {
	// all actions related to emojis
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'kandinsky_disable_wp_emojicons' );





function inline_styles_for_teplitsa_plugins(){
			
	$main_color = knd_get_main_color();
	$dark_color = knd_color_luminance($main_color, -0.1);
	$light_color = knd_color_luminance($main_color, 0.2);
	
	$extra_light_colors = array(
		'#00bcd4' => '#d1f4fa', // color line
		'#de0055' => '#ffcce0', // mstb
		'#f02c80' => '#fde7f1', // dubrovino
	);
	$extra_light_color = !empty($extra_light_colors[strtolower($main_color)]) ? $extra_light_colors[strtolower($main_color)] : $light_color;
	
	$extra_dark_colors = array(
	);
	$extra_dark_color = !empty($extra_dark_colors[strtolower($main_color)]) ? $extra_dark_colors[strtolower($main_color)] : $dark_color;
	
	?>
	<style>
		:root {
			--zoospas-color-main:  <?php echo $main_color;?>;
			--zoospas-main-dark:   <?php echo $extra_dark_color;?>;
			--zoospas-main-light:  <?php echo $extra_light_color;?>;
		}
	</style>
	<?php
}



add_action('wp_head', 'inline_styles_for_teplitsa_plugins', 50 );



define('KND_DOC_URL', 'https://github.com/Teplitsa/kandinsky/wiki/');
define('KND_OFFICIAL_WEBSITE_URL', 'https://knd.te-st.ru/');
define('KND_SOURCES_PAGE_URL', 'https://github.com/Teplitsa/kandinsky/');
define('KND_SOURCES_ISSUES_PAGE_URL', 'https://github.com/Teplitsa/kandinsky/issues/');
define('TST_OFFICIAL_WEBSITE_URL', 'https://te-st.ru/');
define('TST_PASEKA_OFFICIAL_WEBSITE_URL', 'https://paseka.te-st.ru/');
define('KND_SUPPORT_EMAIL', 'support@te-st.ru');
define('KND_SUPPORT_URL', 'https://pd.te-st.ru/forms/contacts/');
define('KND_SUPPORT_TELEGRAM', 'https://t.me/joinchat/AAAAAENN3prSrvAs7KwWrg');
define('KND_SETUP_WIZARD_URL', admin_url('themes.php?page=knd-setup-wizard'));
define('KND_DISTR_ARCHIVE_URL', 'https://github.com/Teplitsa/kandinsky/archive/master.zip');
//define('KND_DISTR_ARCHIVE_URL', 'https://github.com/Teplitsa/kandinsky/archive/dev.zip');

if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

/**
 * Load text domain
 */
function knd_load_theme_textdomain() {
	load_theme_textdomain( 'knd', get_template_directory() . '/lang' );
}

/**
 * Theme Setup
 */
function knd_setup() {

	// Inits.
	knd_load_theme_textdomain();

	// Support automatic feed links.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support('title-tag');

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	// Menus.
	$menus = array(
		'primary' => esc_html__( 'Primary menu', 'knd' ),
	);

	register_nav_menus( $menus );

	// Editor style.
	add_editor_style( array( 'assets/css/editor.css' ) );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'knd_setup', 9 ); // Theme wizard initialize at 10, this init should occur befure it.

/* Fix translate customizer */
if ( is_customize_preview() ) {
	knd_load_theme_textdomain();
}

/**
 * Function for init setting that should be runned at init hook
 */
function knd_content_init() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'knd_content_init', 30 );

/**
 * Includes
 */

// WP libs to operate with files and media.
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

get_template_part( '/core/extras' ); // default WP behavior customization.

/**
 * Template functions
 */
require_once get_theme_file_path( '/core/template-functions.php' );

/**
 * Customizer
 */
require_once get_theme_file_path( '/core/customizer/customizer.php' );

/**
 * Typography and Colors
 */
require_once get_theme_file_path( '/core/typography.php' );

get_template_part( '/core/media' ); // customize media behavior and add images sizes.

get_template_part(  '/core/cards' ); // layout of cards, list items etc.

get_template_part( '/core/shortcodes' ); // shortcodes core.
get_template_part( '/core/shortcodes-ui' ); // shortcodes layout.

get_template_part( '/core/template-tags' ); // independent pages parts layout.

get_template_part( '/core/widgets' ); // setup widgets.

// import data utils.
get_template_part( '/core/class-mediamnt' ); // tools for work with files.

get_template_part( '/core/class-import' ); // import files into site media lib.
get_template_part( '/core/import' ); // import files into site media lib.

// Include modules.
foreach ( glob( get_template_directory() . '/modules/*' ) as $module_file ) {
	if ( is_dir( $module_file ) ) {
		$php_filename = basename( $module_file ) . '.php';
		$php_file     = $module_file . '/' . $php_filename;
	} else {
		$php_file = $module_file;
	}

	if ( is_file( $php_file ) && preg_match( '/.*\.php$/', $php_file ) ) {
		require $php_file;
	}
}

if ( is_admin() || current_user_can( 'manage_options' ) ) {
	get_template_part( '/core/admin-update-theme' );
	get_template_part( '/core/admin' );
	get_template_part( '/vendor/class-tgm-plugin-activation' );
}

if ( ( is_admin() && ! empty( $_GET['page'] ) && $_GET['page'] == 'knd-setup-wizard' ) || wp_doing_ajax() ) {
	get_template_part( '/vendor/envato_setup/envato_setup' ); // Run the wizard after all modules included.
}

// Service lines (to localize):.
esc_html__('Kandinsky', 'knd');
esc_html__('Teplitsa', 'knd');
esc_html__('The beautiful design and useful features for nonprofit website', 'knd');




function widgets_scripts( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'wp-color-picker' ); 
}
add_action( 'admin_enqueue_scripts', 'widgets_scripts' );