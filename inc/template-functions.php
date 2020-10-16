<?php
/**
 * Theme functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Teplitsa
 * @subpackage Kandinsky
 * @since Kandinsky 2.0.0
 */

/**
 * Get Theme Version
 *
 * @return string Current Theme Version.
 */
function kandinsky_theme_version() {
	$time = current_time( 'timestamp' );
	$version = wp_get_theme()->get( 'Version' ) . '-' . $time;
	return $version;
}
