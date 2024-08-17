<?php
// csr_form_post.php

// Include WordPress functions
require_once( dirname(__FILE__) . '/wp-load.php' );
exit;
// Check if the user is logged in
if (!is_user_logged_in()) {
    auth_redirect(); // Redirects to login page if not logged in
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    global $wpdb;

    // Sanitize and prepare data
    $company = sanitize_text_field($_POST['company']);
    $funding_from = intval($_POST['funding_from']);
    $funding_till = intval($_POST['funding_till']);
    $id = sanitize_text_field($_POST['id']);
    $constituency = sanitize_text_field($_POST['constituency']);
    $mandal = sanitize_text_field($_POST['mandal']);
    $village = sanitize_text_field($_POST['village']);
    $name_of_work = sanitize_text_field($_POST['name_of_work']);
    $csr_fund = floatval($_POST['csr_fund']);
    $expenditure = floatval($_POST['expenditure']);
    $status = sanitize_text_field($_POST['status']);
    $work_category = sanitize_text_field($_POST['work_category']);
    $date_sanctioned = sanitize_text_field($_POST['date_sanctioned']);

    // Server-side validation
    if ($funding_till <= $funding_from) {
        wp_die('Funding Till should be greater than Funding From.');
    }

    // Insert data into the database
    $wpdb->insert(
        $wpdb->prefix . 'csr_funding',
        array(
            'company' => $company,
            'funding_from' => $funding_from,
            'funding_till' => $funding_till,
            'id' => $id,
            'constituency' => $constituency,
            'mandal' => $mandal,
            'village' => $village,
            'name_of_work' => $name_of_work,
            'csr_fund' => $csr_fund,
            'expenditure' => $expenditure,
            'status' => $status,
            'work_category' => $work_category,
            'date_sanctioned' => $date_sanctioned,
        ),
        array(
            '%s', // company
            '%d', // funding_from as number
            '%d', // funding_till as number
            '%s', // id
            '%s', // constituency
            '%s', // mandal
            '%s', // village
            '%s', // name_of_work
            '%f', // csr_fund
            '%f', // expenditure
            '%s', // status
            '%s', // work_category
            '%s', // date_sanctioned
        )
    );

    // Redirect or show a success message
    wp_redirect(home_url('/thank-you/'));
    exit;
}
?>
