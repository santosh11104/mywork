<?php
/**
 * Plugin Name: CSR Import Plugin
 * Description: A plugin to import CSR data from a CSV file into the database.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include the main class file.
require_once plugin_dir_path(__FILE__) . 'includes/class-csr-import.php';

// Instantiate the plugin class.
CSR_Import::get_instance();

