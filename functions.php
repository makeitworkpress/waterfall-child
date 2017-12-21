<?php
/**
 * Child Theme functions for the Waterfall Child Theme
 * These theme automatically loads classes inside the folder classes or vendor, as long as they are properly namespaced.
 */

/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($classname) {
    
    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($classname) ) );
    
    $classes    = get_template_directory() .  DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
    $child      = get_stylesheet_directory() .  DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
    
    $vendor     = str_replace( 'makeitworkpress' . DIRECTORY_SEPARATOR, '', $class );
    $vendor     = 'makeitworkpress' . DIRECTORY_SEPARATOR . preg_replace( '/\//', '/src/', $vendor, 1 ); // Replace the first slash for the src folder
    $vendors    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . $vendor . '.php';
    
    if( file_exists($classes) ) {
        require_once( $classes );
    } elseif( file_exists($child) ) {
        require_once( $child );    
    } elseif( file_exists($vendors) ) {
        require_once( $vendors );    
    }
   
} );

/**
 * Inializes our theme instance. On other occasions, the instance can be retrieved in a similar manner.
 */
$theme = WFC_Theme::instance();