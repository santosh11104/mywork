<?php

/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if (! function_exists('twentytwentyfour_block_styles')) :
    /**
     * Register custom block styles
     *
     * @since Twenty Twenty-Four 1.0
     * @return void
     */
    function twentytwentyfour_block_styles()
    {

        register_block_style(
            'core/details',
            array(
                'name'         => 'arrow-icon-details',
                'label'        => __('Arrow icon', 'twentytwentyfour'),
                /*
				 * Styles for the custom Arrow icon style of the Details block
				 */
                'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
            )
        );
        register_block_style(
            'core/post-terms',
            array(
                'name'         => 'pill',
                'label'        => __('Pill', 'twentytwentyfour'),
                /*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
                'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
            )
        );
        register_block_style(
            'core/list',
            array(
                'name'         => 'checkmark-list',
                'label'        => __('Checkmark', 'twentytwentyfour'),
                /*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
                'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
            )
        );
        register_block_style(
            'core/navigation-link',
            array(
                'name'         => 'arrow-link',
                'label'        => __('With arrow', 'twentytwentyfour'),
                /*
				 * Styles for the custom arrow nav link block style
				 */
                'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
            )
        );
        register_block_style(
            'core/heading',
            array(
                'name'         => 'asterisk',
                'label'        => __('With asterisk', 'twentytwentyfour'),
                'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
            )
        );
    }
endif;

add_action('init', 'twentytwentyfour_block_styles');

/**
 * Enqueue block stylesheets.
 */

if (! function_exists('twentytwentyfour_block_stylesheets')) :
    /**
     * Enqueue custom block stylesheets
     *
     * @since Twenty Twenty-Four 1.0
     * @return void
     */
    function twentytwentyfour_block_stylesheets()
    {
        /**
         * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
         * for a specific block. These will only get loaded when the block is rendered
         * (both in the editor and on the front end), improving performance
         * and reducing the amount of data requested by visitors.
         *
         * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
         */
        wp_enqueue_block_style(
            'core/button',
            array(
                'handle' => 'twentytwentyfour-button-style-outline',
                'src'    => get_parent_theme_file_uri('assets/css/button-outline.css'),
                'ver'    => wp_get_theme(get_template())->get('Version'),
                'path'   => get_parent_theme_file_path('assets/css/button-outline.css'),
            )
        );
    }
endif;

add_action('init', 'twentytwentyfour_block_stylesheets');

/**
 * Register pattern categories.
 */

if (! function_exists('twentytwentyfour_pattern_categories')) :
    /**
     * Register pattern categories
     *
     * @since Twenty Twenty-Four 1.0
     * @return void
     */
    function twentytwentyfour_pattern_categories()
    {

        register_block_pattern_category(
            'twentytwentyfour_page',
            array(
                'label'       => _x('Pages', 'Block pattern category', 'twentytwentyfour'),
                'description' => __('A collection of full page layouts.', 'twentytwentyfour'),
            )
        );
    }
endif;

add_action('init', 'twentytwentyfour_pattern_categories');
function display_submission_form()
{

    global $wpdb;
    if (! is_user_logged_in()) {
        wp_redirect(wp_login_url()); // Redirect to the login page if not logged in
        exit;
    }
    $years = range(1950, 2100);
    $yearOptions = '';
    foreach ($years as $year) {
        $yearOptions .= "<option value='{$year}'>{$year}</option>";
    }
    $companies = $wpdb->get_results("SELECT id, name FROM {$wpdb->prefix}companies ORDER BY name ASC");
    $companyOptions = '<option value="" disabled selected>Please select</option>';
    foreach ($companies as $company) {
        $companyOptions .= "<option value='{$company->id}'>{$company->name}</option>";
    }

    // Fetch constituency data from the database
    $constituencies = $wpdb->get_results("SELECT id, name FROM {$wpdb->prefix}constituencies ORDER BY name ASC");
    $constituencyOptions = '<option value="" disabled selected>Please select</option>';
    foreach ($constituencies as $constituency) {
        $constituencyOptions .= "<option value='{$constituency->id}'>{$constituency->name}</option>";
    }
    /* $workCategories = [
        'Roads',
        'Drainage',
        'Endowments',
        'Sports',
        'Sports',
        'Disaster Management',
        'Fisheries',
        'Health',
        'Sanitation',
        'Solar',
        'Plantation'
    ];*/
    $workCategories = $wpdb->get_results("SELECT id, name FROM {$wpdb->prefix}workcategories ORDER BY name ASC");
    $workCategoryOptions = '<option value="" disabled selected>Please select</option>';
    foreach ($workCategories as $workCategory) {
        $workCategoryOptions .= "<option value='{$workCategory->id}'>{$workCategory->name}</option>";
    }
    $departments = $wpdb->get_results("SELECT id, name FROM {$wpdb->prefix}departments ORDER BY name ASC");
    $departmentOptions = '<option value="" disabled selected>Please select</option>';
    foreach ($departments as $department) {
        $departmentOptions .= "<option value='{$department->id}'>{$department->name}</option>";
    }

    $mandals = $wpdb->get_results("SELECT id, name FROM {$wpdb->prefix}mandals ORDER BY name ASC");
    $mandalOptions = '<option value="" disabled selected>Please select</option>';
    foreach ($mandals as $mandal) {
        $mandalOptions .= "<option value='{$mandal->id}'>{$mandal->name}</option>";
    }

    $statusOptions = [
        'Completed',
        'In Progress',
        'Not Started',
    ];
    $statusDropdownOptions = '<option value="" disabled selected>Please select</option>';
    foreach ($statusOptions as $status) {
        $statusDropdownOptions .= "<option value='{$status}'>{$status}</option>";
    }

    $form = '<form id="submissionForm" method="POST" action="' . admin_url('admin-post.php?action=handle_csr_form') . '" style="max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">

        <div style="display: flex; flex-wrap: wrap;">

            <div style="flex: 1; min-width: 300px; margin-right: 20px;">
                 <label for="company" style="display: block; margin-bottom: 8px; font-weight: bold;">Company:</label>
                <select id="company" name="company" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    ' . $companyOptions . '
                </select>
                
                <label for="funding_year" style="display: block; margin-bottom: 8px; font-weight: bold;">Funding Year:</label>
                <input type="text" id="funding_year" name="funding_year" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                
                <label for="id" style="display: block; margin-bottom: 8px; font-weight: bold;">ID:</label>
                <input type="number" id="id" name="id" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                
                 <label for="constituency" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency:</label>
                <select id="constituency" name="constituency" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    ' . $constituencyOptions . '
                </select>
                
                <label for="village" style="display: block; margin-bottom: 8px; font-weight: bold;">Village:</label>
                <input type="text" id="village" name="village" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                
                <label for="csr_fund" style="display: block; margin-bottom: 8px; font-weight: bold;">CSR Fund:</label>
                <input type="number" id="csr_fund" name="csr_fund" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                
                <label for="work_category" style="display: block; margin-bottom: 8px; font-weight: bold;">Work Category:</label>
                <select id="work_category" name="work_category" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    ' . $workCategoryOptions . '
                </select>
                <label for="department" style="display: block; margin-bottom: 8px; font-weight: bold;">Departments:</label>
                <select id="department" name="department" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    ' . $departmentOptions . '
                </select>
                 <label for="mandal" style="display: block; margin-bottom: 8px; font-weight: bold;">Mandals:</label>
                <select id="mandal" name="mandal" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    ' . $mandalOptions . '
                </select>
            </div>

            <div style="flex: 1; min-width: 300px;">
               <label for="name_of_work" style="display: block; margin-bottom: 8px; font-weight: bold;">Name of Work:</label>
                <input type="text" id="name_of_work" class="textarea-like" name="name_of_work" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                
                <label for="expenditure" style="display: block; margin-bottom: 8px; font-weight: bold;">Expenditure:</label>
                <input type="number" id="expenditure" name="expenditure" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                
                <label for="status" style="display: block; margin-bottom: 8px; font-weight: bold;">Status:</label>
                <select id="status" name="status" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    ' . $statusDropdownOptions . '
                </select>
                
                <label for="date_sanctioned" style="display: block; margin-bottom: 8px; font-weight: bold;">Date Sanctioned:</label>
                <input type="text" id="date_sanctioned" name="date_sanctioned" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                 <label for="executive_agency" style="display: block; margin-bottom: 8px; font-weight: bold;">Executive Agency:</label>
                <input type="text" id="executive_agency" name="executive_agency" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
            </div>

        </div>

        <div style="text-align: center;">
            <input type="submit" value="Submit" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #0073aa; color: white; border-radius: 5px; cursor: pointer;">
        </div>
    </form>';

    // Add jQuery validation script
    $form .= '<script>
    jQuery(document).ready(function($) {
        $("#submissionForm").submit(function(event) {
            var status = $("#status").val();
            var workCategory = $("#work_category").val();
            return true;
        });

        // Initialize the date picker
        $("#date_sanctioned").datepicker({
            dateFormat: "dd/mm/yy",  // Ensure this matches the display format
        changeMonth: true,
        changeYear: true
        });
    });
    </script>';

    return $form;
}
add_shortcode('submission_form', 'display_submission_form');




function enqueue_custom_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
// Hook into admin-post.php for handling form submissions
add_action('admin_post_handle_csr_form', 'handle_csr_form');
add_action('admin_post_nopriv_handle_csr_form', 'handle_csr_form');

function handle_csr_form()
{

    // Check if the user is logged in
    if (! is_user_logged_in()) {
        wp_redirect(home_url('/login')); // Redirect to login page if not logged in
        exit;
    }
    $current_user_id = get_current_user_id();
    // Check if the request is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;

        // Sanitize and validate form data
        $company = intval($_POST['company']);
        $funding_year = intval($_POST['funding_year']);
         
        $id = sanitize_text_field($_POST['id']);
        $constituency = intval($_POST['constituency']); // Sanitize as an integer
        $department = intval($_POST['department']); // Sanitize as an integer
        $constituency = intval($_POST['constituency']); // Sanitize as an integer
        $mandal = intval($_POST['mandal']); // Sanitize as an integer
        $village = sanitize_text_field($_POST['village']);
        $name_of_work = sanitize_text_field($_POST['name_of_work']);
        $csr_fund = floatval($_POST['csr_fund']);
        $expenditure = floatval($_POST['expenditure']);
        $status = sanitize_text_field($_POST['status']);
        $date_sanctioned = sanitize_text_field($_POST['date_sanctioned']);
        $executive_agency = sanitize_text_field($_POST['executive_agency']);
        $date_parts = explode('/', $date_sanctioned); // Splitting the date by "-"

        if (count($date_parts) === 3) {
            $date_sanctioned = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
        } else {
            wp_redirect(home_url('/form-submission-error?message=date_format_error'));
            exit;
        }

        $work_category = intval($_POST['work_category']); // Sanitize as an integer

        

        // Insert into database (example table: wp_csr_submissions)
        $table = $wpdb->prefix . 'csr_submissions';

        $result =    $wpdb->insert($table, [
            'company_id' => $company,
            'funding_year' => $funding_year,
            'id' => $id,
            'constituency_id' => $constituency,
            'department_id' => $department,
            'mandal_id' => $mandal,
            'village' => $village,
            'name_of_work' => $name_of_work,
            'csr_fund' => $csr_fund,
            'expenditure' => $expenditure,
            'status' => $status,
            'date_sanctioned' => $date_sanctioned,
            'work_category_id' => $work_category,
            'executive_agency' => $executive_agency,
            'createdBy' => $current_user_id,
            'modifiedBy' => $current_user_id
        ]);
        
        // Check if the insert was successful
        if ($result !== false) {
            
            // Redirect to the same page with a success message
            wp_redirect(add_query_arg('submission_status', 'success', home_url('/csr-submissions-list')));
            exit;
        } else {
            echo '<div style="color: red; font-weight: bold;">Error: Failed to insert the details.</div>';
        }
        exit;
    } else {
        // If not POST request
        wp_die('Invalid request.');
    }
}
function display_add_constituency_form()
{
    $form = '<form method="POST" action="' . admin_url('admin-post.php?action=add_constituency') . '" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <h2>Add New Constituency</h2>
        <label for="constituency_name" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency Name:</label>
        <input type="text" id="constituency_name" name="constituency_name" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
        
        <input type="submit" value="Add Constituency" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #0073aa; color: white; border-radius: 5px; cursor: pointer;">
    </form>';

    return $form;
}
add_shortcode('add_constituency_form', 'display_add_constituency_form');


function handle_add_constituency()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/login')); // Redirect to login page if not logged in
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;
        $constituency_name = sanitize_text_field($_POST['constituency_name']);

        // Insert the new constituency into the database
        $table = $wpdb->prefix . 'constituencies';
        $result = $wpdb->insert($table, ['name' => $constituency_name]);

        // Redirect based on the result
        if ($result) {
            wp_redirect(home_url('/'));
        } else {
            wp_redirect(home_url('/form-submission-error?message=db_error'));
        }
        exit;
    } else {
        wp_die('Invalid request.');
    }
}
add_action('admin_post_add_constituency', 'handle_add_constituency');
add_action('admin_post_nopriv_add_constituency', 'handle_add_constituency');

function create_constituencies_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'constituencies';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}




add_action('after_setup_theme', 'create_constituencies_table');

function create_csr_submissions_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'csr_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        csr_id int(12 ) NOT NULL auto_increment,
        id int(12) NOT NULL,
        company_id INT UNSIGNED NOT NULL,
        funding_year varchar(64) NOT NULL,
        constituency_id INT UNSIGNED NOT NULL,
        mandal_id INT UNSIGNED NOT NULL,
        village VARCHAR(255) NOT NULL,
        name_of_work TEXT NOT NULL,
        csr_fund DECIMAL(10, 2)  NULL,
        expenditure DECIMAL(10, 2) NULL,
       `status` VARCHAR(50) NOT NULL,
        work_category_id INT UNSIGNED NOT NULL,
        date_sanctioned DATE NOT NULL,
        executive_agency varchar(255) NOT NULL,
        department_id INT UNSIGNED NOT NULL,
        `createDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `modifiedDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `createdBy` int(10) unsigned NOT NULL,
         `modifiedBy` int(10) unsigned DEFAULT NULL,

        PRIMARY KEY (csr_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


add_action('after_setup_theme', 'create_csr_submissions_table');
add_action('admin_post_update_csr_form', 'update_csr_form');

function update_csr_form()
{
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/login'));
        exit;
    }

    if (isset($_POST['record_id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'csr_submissions';

        $record_id = intval($_POST['record_id']);
        $id = intval($_POST['id']);
        $company = intval($_POST['company']);
        $funding_year = intval($_POST['funding_year']);
        
        $constituency_id = intval($_POST['constituency']);
        $mandal = intval($_POST['mandal']);
        $village = sanitize_text_field($_POST['village']);
        $name_of_work = sanitize_text_field($_POST['name_of_work']);
        $csr_fund = floatval($_POST['csr_fund']);
        $expenditure = floatval($_POST['expenditure']);
        $status = sanitize_text_field($_POST['status']);
        $work_category = intval($_POST['work_category']);
        $department = intval($_POST['department']);
        $date_sanctioned = sanitize_text_field($_POST['date_sanctioned']);
        $executive_agency = sanitize_text_field($_POST['executive_agency']);

        $wpdb->update(
            $table_name,
            array(
                'company_id' => $company,
                'funding_year' => $funding_year,
                
                'constituency_id' => $constituency_id,
                'mandal_id' => $mandal,
                'village' => $village,
                'name_of_work' => $name_of_work,
                'csr_fund' => $csr_fund,
                'expenditure' => $expenditure,
                'status' => $status,
                'work_category_id' => $work_category,
                'date_sanctioned' => $date_sanctioned,
                'id' => $id,
                'executive_agency' => $executive_agency,
                'department_id' => $department

            ),
            array('csr_id' => $record_id)
        );
        

        //  wp_redirect(home_url('/edit-csr?id=' . $record_id . '&updated=true'));
        wp_redirect(add_query_arg('submission_status_edit', 'success', home_url('/csr-submissions-list')));
        exit;
    } else {
        wp_redirect(home_url('/csr-list?error=missing_id'));
        exit;
    }
}

function my_custom_theme_menu()
{
    // Get the current user object
    $current_user = wp_get_current_user();

    // Define the roles that are allowed to see the menu
    $allowed_roles = array('administrator', 'author', 'subscriber');

    // Check if the current user has one of the allowed roles
    if (array_intersect($allowed_roles, $current_user->roles)) {
        add_menu_page(
            'My Custom Links',         // Page title
            'Custom Links',            // Menu title
            'read',                    // Capability
            'my-custom-links',         // Menu slug
            'my_custom_links_page',    // Function to display the page content
            'dashicons-admin-links',   // Icon URL
            4                          // Position
        );
    }
}

add_action('admin_menu', 'my_custom_theme_menu');

function my_custom_links_page()
{
    echo '<div class="wrap">';
    echo '<h1>My Custom Links</h1>';
    echo '<ul>';
    echo '<li><a href="' . WP_SITEURL . '/csr-submissions-list/" >CSR Submissions</a></li>';
    echo '<li><a href="' . WP_SITEURL . '/add-csr-works"  >Add CSR Form</a></li>';
    echo '<li><a href="' . WP_SITEURL . '/add-constituency"  >Add Constituency</a></li>';
    echo '<li><a href="' . WP_SITEURL . '/add-company"  >Add Company</a></li>';

    echo '</ul>';
    echo '</div>';
}

function display_add_company_form()
{
    $form = '<form method="POST" action="' . admin_url('admin-post.php?action=add_company') . '" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <h2>Add New Company</h2>
        <label for="company_name" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency Name:</label>
        <input type="text" id="company_name" name="company_name" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
        
        <input type="submit" value="Add Company" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #0073aa; color: white; border-radius: 5px; cursor: pointer;">
    </form>';

    return $form;
}
add_shortcode('add_company_form', 'display_add_company_form');


function handle_add_company()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/login')); // Redirect to login page if not logged in
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;
        $company_name = sanitize_text_field($_POST['company_name']);

        // Insert the new company into the database
        $table = $wpdb->prefix . 'companies';
        $result = $wpdb->insert($table, ['name' => $company_name]);

        // Redirect based on the result
        if ($result) {
            wp_redirect(home_url('/'));
        } else {
            wp_redirect(home_url('/form-submission-error?message=db_error'));
        }
        exit;
    } else {
        wp_die('Invalid request.');
    }
}

add_action('admin_post_add_company', 'handle_add_company');
add_action('admin_post_nopriv_add_company', 'handle_add_company');

function create_companies_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'companies';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}




add_action('after_setup_theme', 'create_companies_table');


function display_add_workcategory_form()
{
    $form = '<form method="POST" action="' . admin_url('admin-post.php?action=add_workcategory') . '" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <h2>Add New workcategory</h2>
        <label for="workcategory_name" style="display: block; margin-bottom: 8px; font-weight: bold;">Work Category Name:</label>
        <input type="text" id="workcategory_name" name="workcategory_name" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
        
        <input type="submit" value="Add workcategory" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #0073aa; color: white; border-radius: 5px; cursor: pointer;">
    </form>';

    return $form;
}
add_shortcode('add_workcategory_form', 'display_add_workcategory_form');


function handle_add_workcategory()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/login')); // Redirect to login page if not logged in
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;
        $workcategory_name = sanitize_text_field($_POST['workcategory_name']);

        // Insert the new workcategory into the database
        $table = $wpdb->prefix . 'workcategories';
        $result = $wpdb->insert($table, ['name' => $workcategory_name]);

        // Redirect based on the result
        if ($result) {
            wp_redirect(home_url('/'));
        } else {
            wp_redirect(home_url('/form-submission-error?message=db_error'));
        }
        exit;
    } else {
        wp_die('Invalid request.');
    }
}

add_action('admin_post_add_workcategory', 'handle_add_workcategory');
add_action('admin_post_nopriv_add_workcategory', 'handle_add_workcategory');

function create_workcategories_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'workcategories';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}




add_action('after_setup_theme', 'create_workcategories_table');

function display_add_department_form()
{
    $form = '<form method="POST" action="' . admin_url('admin-post.php?action=add_department') . '" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <h2>Add New Department</h2>
        <label for="department_name" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency Name:</label>
        <input type="text" id="department_name" name="department_name" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
        
        <input type="submit" value="Add Department" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #0073aa; color: white; border-radius: 5px; cursor: pointer;">
    </form>';

    return $form;
}
add_shortcode('add_department_form', 'display_add_department_form');


function handle_add_department()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/login')); // Redirect to login page if not logged in
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;
        $department_name = sanitize_text_field($_POST['department_name']);

        // Insert the new department into the database
        $table = $wpdb->prefix . 'departments';
        $result = $wpdb->insert($table, ['name' => $department_name]);

        // Redirect based on the result
        if ($result) {
            wp_redirect(home_url('/'));
        } else {
            wp_redirect(home_url('/form-submission-error?message=db_error'));
        }
        exit;
    } else {
        wp_die('Invalid request.');
    }
}

add_action('admin_post_add_department', 'handle_add_department');
add_action('admin_post_nopriv_add_department', 'handle_add_department');

function create_departments_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'departments';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}




add_action('after_setup_theme', 'create_departments_table');

function display_add_mandal_form()
{
    $form = '<form method="POST" action="' . admin_url('admin-post.php?action=add_mandal') . '" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <h2>Add New mandal</h2>
        <label for="mandal_name" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency Name:</label>
        <input type="text" id="mandal_name" name="mandal_name" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
        
        <input type="submit" value="Add mandal" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #0073aa; color: white; border-radius: 5px; cursor: pointer;">
    </form>';

    return $form;
}
add_shortcode('add_mandal_form', 'display_add_mandal_form');


function handle_add_mandal()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/login')); // Redirect to login page if not logged in
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;
        $mandal_name = sanitize_text_field($_POST['mandal_name']);

        // Insert the new mandal into the database
        $table = $wpdb->prefix . 'mandals';
        $result = $wpdb->insert($table, ['name' => $mandal_name]);

        // Redirect based on the result
        if ($result) {
            wp_redirect(home_url('/'));
        } else {
            wp_redirect(home_url('/form-submission-error?message=db_error'));
        }
        exit;
    } else {
        wp_die('Invalid request.');
    }
}

add_action('admin_post_add_mandal', 'handle_add_mandal');
add_action('admin_post_nopriv_add_mandal', 'handle_add_mandal');

function create_mandals_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'mandals';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}




add_action('after_setup_theme', 'create_mandals_table');
