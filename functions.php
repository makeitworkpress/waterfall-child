<?php
/**
 * Child Theme functions for the Waterfall Child Theme
 * This theme automatically loads classes inside the folder classes or vendor, as long as they are properly namespaced.
 * 
 * Inializes our theme instance. On other occasions, the instance can be retrieved in a similar manner.
 * This is hooked on after_setup_theme, meaning our parent functions.php is executed before this allowing the autoloading from the parent theme to kick in.
 * Priority 5 is required so that configurations can still be altered before the parent theme adds them
 */
add_action('after_setup_theme', function() {
    $theme = WFC_Theme::instance();
}, 5);