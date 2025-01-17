<?php
// Ensure WordPress environment is loaded
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if the user is logged in
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink())); // Redirect to the login page
    exit; // Stop further execution
}

/* Template Name: CSR List */
get_header();

?>

<div class="container">
    <h1>CSR Submissions</h1>

    <?php
    global $wpdb;

    // Define table names
    $table_name           = $wpdb->prefix . 'csr_submissions';
    $constituencies_table = $wpdb->prefix . 'constituencies';
    $companies_table      = $wpdb->prefix . 'companies';
    $departments_table    = $wpdb->prefix . 'departments';
    $workcategories_table = $wpdb->prefix . 'workcategories';
    $mandals_table        = $wpdb->prefix . 'mandals';

    // Pagination settings
    $items_per_page = 10; // Set the number of items per page
    $current_page   = max(1, get_query_var('paged'));
    $offset         = ($current_page - 1) * $items_per_page;

    // Query to fetch CSR submissions along with related data, with pagination
    $results = $wpdb->get_results($wpdb->prepare("
        SELECT 
            submissions.csr_id,
            submissions.id,
            companies.name AS company_name,
            departments.name AS department_name,
            constituencies.name AS constituency_name,
            workcategories.name AS workcategory_name,
            submissions.funding_year,
            mandals.name AS mandal_name,
            submissions.village,
            submissions.name_of_work,
            submissions.csr_fund,
            submissions.expenditure,
            submissions.status,
            submissions.date_sanctioned,
            submissions.executive_agency
        FROM 
            $table_name AS submissions
        INNER JOIN 
            $constituencies_table AS constituencies ON submissions.constituency_id = constituencies.id
        INNER JOIN 
            $companies_table AS companies ON submissions.company_id = companies.id
        INNER JOIN 
            $mandals_table AS mandals ON submissions.mandal_id = mandals.id             
        INNER JOIN 
            $departments_table AS departments ON submissions.department_id = departments.id 
        INNER JOIN  
            $workcategories_table AS workcategories ON submissions.work_category_id = workcategories.id
        ORDER BY 
            submissions.date_sanctioned DESC
        LIMIT %d OFFSET %d
    ", $items_per_page, $offset));

    // Get total number of items for pagination
    $total_items = $wpdb->get_var("
        SELECT COUNT(*) 
        FROM $table_name AS submissions
        INNER JOIN $constituencies_table AS constituencies ON submissions.constituency_id = constituencies.id
    ");

    $total_pages = ceil($total_items / $items_per_page);
    ?>

    <?php if ($results): ?>
        <table class="wp-list-table widefat fixed striped csr-table" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Department</th>
                    <th>Funding Year</th>
                    <th>Constituency</th>
                    <th>Mandal</th>
                    <th>Village</th>
                    <th>Name of Work</th>
                    <th>CSR Fund</th>
                    <th>Expenditure</th>
                    <th>Status</th>
                    <th>Work Category</th>
                    <th>Date Sanctioned</th>
                    <th>Executive Agency</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo esc_html($row->id); ?></td>
                        <td><?php echo esc_html($row->company_name); ?></td>
                        <td><?php echo esc_html($row->department_name); ?></td>
                        <td><?php echo esc_html($row->funding_year); ?></td>
                        <td><?php echo esc_html($row->constituency_name); ?></td>
                        <td><?php echo esc_html($row->mandal_name); ?></td>
                        <td><?php echo esc_html($row->village); ?></td>
                        <td><?php echo wpautop(esc_html($row->name_of_work)); ?></td>
                        <td><?php echo esc_html(number_format($row->csr_fund, 0)); ?></td>
                        <td><?php echo esc_html(number_format($row->expenditure, 0)); ?></td>
                        <td><?php echo esc_html($row->status); ?></td>
                        <td><?php echo esc_html($row->workcategory_name); ?></td>
                        <td><?php echo esc_html(date('d-m-Y', strtotime($row->date_sanctioned))); ?></td>
                        <td><?php echo esc_html($row->executive_agency); ?></td>
                        <td><a href="<?php echo esc_url(add_query_arg('action', 'edit', add_query_arg('csr_id', $row->csr_id, home_url('/edit-csr')))); ?>" class="edit-link">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>

    <?php
    // Pagination
    if ($total_pages > 1) {
        $pagination = paginate_links([
            'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'total'     => $total_pages,
            'current'   => $current_page,
            'format'    => '?paged=%#%',
            'prev_text' => __('« Prev'),
            'next_text' => __('Next »'),
            'end_size'  => 1,
            'mid_size'  => 1,
            'type'      => 'list',
        ]);

        if ($pagination) {
            echo '<div class="pagination">' . $pagination . '</div>';
        }
    }
    ?>
</div>

<?php get_footer(); ?>
