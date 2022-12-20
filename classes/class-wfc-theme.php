<?php
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

/**
 * Loads our child theme
 */
class WFC_Theme {
  
    /**
     * Determines whether a class has already been instanciated.
     * @access private
     */
    private static $instance = null;

    /**
     * Initial constructor
     */
    private function __construct() {}

    /**
     * Retrieve and return the single instance
     */
    public static function instance() {
        
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->launch();
        }

        return self::$instance;
        
    }    

    /**
     * Launches our theme - used to add configurations and so forth
     */
    private function launch() {

        // Loads our parent
        $parent = Waterfall::instance();

        // Load our configurations
        require_once( get_stylesheet_directory() . '/config/configurations.php' );            

        // Only a set of predefined configurations can be added
        foreach( $configurations as $name => $configurations ) {

            if( ! in_array($name, ['register', 'routes', 'options', 'enqueue', 'elementor']) ) {
                continue;
            } 

            $parent->config->add( $name, $configurations );

        }

    }


}