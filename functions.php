<?php
/**
 * Child Theme functions for the Waterfall Child Theme
 * These theme automatically loads classes inside the folder classes or vendor, as long as they are properly namespaced.
 */

/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($className) {
    
    $calledClass    = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($className) ) );
    $parentDir      = get_template_directory() . DIRECTORY_SEPARATOR;
    
    // Require main parent classes
    $parentClass    = $parentDir . 'classes' . DIRECTORY_SEPARATOR . $calledClass . '.php';

    if( file_exists($parentClass) ) {
        require_once( $parentClass );
        return;
    } 

    // Require child theme classes
    $childClass     = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $calledClass . '.php';

    if( file_exists($childClass) ) {
        require_once( $childClass );
        return;
    }
    
    // Require Vendor (composer) classes
    $classNames     = explode(DIRECTORY_SEPARATOR, $calledClass);
    array_splice($classNames, 2, 0, 'src');

    $vendorClass    = $parentDir . 'vendor' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classNames) . '.php';

    if( file_exists($vendorClass) ) {
        require_once( $vendorClass );    
    }
   
} );

/**
 * Inializes our theme instance. On other occasions, the instance can be retrieved in a similar manner.
 */
$theme = WFC_Theme::instance();