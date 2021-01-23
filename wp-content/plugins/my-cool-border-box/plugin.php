<?php

/**
 * Plugin Name: My Cool Border Box
 * Author: Mike
 * Version: 1.0.0
 */

 function loadMyBlockFiles() {
     wp_enqueue_script(
         'my-super-unique-handle',
         plugin_dir_url(__FILE__) . 'my-block.js', 
         array('wp-blocks', 'wp-i18n', 'wp-editor'),
         true
     );
     wp_enqueue_script('another-unique-handle',
     plugin_dir_url(__FILE__) . 'green-heading.js', array(
         'wp-blocks', 'wp-i18n', 'wp-editor'
     ), true
    );
 }

 add_action('enqueue_block_editor_assets', 'loadMyBlockFiles');