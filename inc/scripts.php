<?php
/**
 * Scripts
 *
 * @package Teplitsa
 * @subpackage Kandinsky
 * @since Kandinsky 2.0.0
 */

/**
 * Theme Scripts
 */
function kandinsky_scripts() {

	// Theme styles.
	wp_enqueue_style( 'kandinsky', get_template_directory_uri() . '/style.css', array(), kandinsky_theme_version() );

	wp_dequeue_style( 'leyka-plugin-styles' );

	// Theme scripts.
	wp_enqueue_script( 'kandinsky', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), kandinsky_theme_version(), true );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'kandinsky', 'frontend',
		array(
			'ajaxurl'      => admin_url( 'admin-ajax.php' ),
			'nonce'        => wp_create_nonce( 'myajax-nonce' ),
			'langContinue' => esc_html__( 'Continue', 'kandinsky' ),
		)
	);

}
add_action( 'wp_enqueue_scripts', 'kandinsky_scripts' );

/**
 * Admin Scripts
 *
 * @param string $hook The current admin page.
 */
function kandinsky_admin_scripts( $hook ) {

	// Admin styles.
	wp_enqueue_style( 'kandinsky-admin', get_template_directory_uri() . 'assets/css/admin.css', array(), kandinsky_theme_version() );
	// Admin scripts.
	wp_enqueue_script( 'kandinsky-admin', get_template_directory_uri() . 'assets/js/admin.js', array( 'jquery' ), kandinsky_theme_version(), true );

	/* Translatable string */
	wp_localize_script('kandinsky-admin', 'knd',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'knd-nonce' ),
		)
	);

}
add_action( 'admin_enqueue_scripts', 'kandinsky_admin_scripts' );
