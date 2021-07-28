<?php
/**
 * Child Theme functions for the Waterfall Child Theme
 * These theme automatically loads classes inside the folder classes or vendor, as long as they are properly namespaced.
 */

/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($class_name) {
    
    $called_class       = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($class_name) ) );
    $theme_dir          = get_template_directory() . DIRECTORY_SEPARATOR;
    
    // Require main parent classes
    $class_names        = explode(DIRECTORY_SEPARATOR, $called_class);
    $class_filename     = 'class-' . array_pop($class_names);
    $class_rel_path     = $class_names ? implode(DIRECTORY_SEPARATOR, $class_names) . DIRECTORY_SEPARATOR . $class_filename : $class_filename;
    $theme_class_file   = $theme_dir . 'classes' . DIRECTORY_SEPARATOR . $class_rel_path . '.php';

    if( file_exists( $theme_class_file ) ) {
        require_once( $theme_class_file );
        return;
    } 

    $child_class_file   = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class_rel_path . '.php';
    
    if( file_exists($child_class_file) ) {
        require_once( $child_class_file );
        return;
    }   
    
    // Require Vendor (composer) classes
    array_splice($class_names, 2, 0, 'src');
    $class_filename     = str_replace('class-', '', $class_filename); // PSR-4 modules can not follow the WordPress file naming convention
    $vendor_class_file  = $theme_dir . 'vendor' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_names) . DIRECTORY_SEPARATOR . $class_filename . '.php';

    if( file_exists($vendor_class_file) ) {
        require_once( $vendor_class_file );    
    }
   
} );

/**
 * Inializes our theme instance. On other occasions, the instance can be retrieved in a similar manner.
 */
$theme = WFC_Theme::instance();