<?php
/**
 * Our basic configurations, which inject our configurations inside the parent theme
 */
$configurations = [
    'enqueue' => [
        ['handle' => 'wfc-styles', 'src' => get_stylesheet_directory_uri() . '/assets/css/style.min.css'], 
    ]
];
