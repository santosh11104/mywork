<?php
// Ensure WordPress environment is loaded
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if the user is logged in
if (!is_user_logged_in()) {
    // Redirect to the login page
    wp_redirect(wp_login_url(get_permalink())); 
    exit; // Stop further execution
}

/* Template Name: CSR List */
get_header(); 

// Number of items per page
$items_per_page = 10;

// Get the current page
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;

// Calculate offset
$offset = ($current_page - 1) * $items_per_page;

global $wpdb;
$table_name = $wpdb->prefix . 'csr_submissions';
$constituencies_table = $wpdb->prefix . 'constituencies';

// Get the total number of records
$total_items = $wpdb->get_var("
    SELECT COUNT(*) 
    FROM $table_name AS submissions
    INNER JOIN $constituencies_table AS constituencies
    ON submissions.constituency_id = constituencies.id
");

// Calculate total pages
$total_pages = ceil($total_items / $items_per_page);

// Query to fetch CSR submissions along with constituency names, with pagination
$query = $wpdb->prepare("
    SELECT 
        submissions.csr_id,
        submissions.id,
        submissions.company,
        submissions.funding_from,
        submissions.funding_till,
        constituencies.name AS constituency_name,
        submissions.mandal,
        submissions.village,
        submissions.name_of_work,
        submissions.csr_fund,
        submissions.expenditure,
        submissions.status,
        submissions.work_category,
        submissions.date_sanctioned,
        submissions.executive_agency
    FROM 
        $table_name AS submissions
    INNER JOIN 
        $constituencies_table AS constituencies
    ON 
        submissions.constituency_id = constituencies.id
    ORDER BY 
        submissions.date_sanctioned DESC
    LIMIT %d OFFSET %d
", $items_per_page, $offset);

$results = $wpdb->get_results($query);
?>

<div class="container">
    <h1>CSR Submissions</h1>

    <?php if ($results): ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>CSR ID</th>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Funding From</th>
                    <th>Funding Till</th>
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
                        <td><?php echo esc_html($row->csr_id); ?></td>
                        <td><?php echo esc_html($row->id); ?></td>
                        <td><?php echo esc_html($row->company); ?></td>
                        <td><?php echo esc_html($row->funding_from); ?></td>
                        <td><?php echo esc_html($row->funding_till); ?></td>
                        <td><?php echo esc_html($row->constituency_name); ?></td>
                        <td><?php echo esc_html($row->mandal); ?></td>
                        <td><?php echo esc_html($row->village); ?></td>
                        <td><?php echo esc_html($row->name_of_work); ?></td>
                        <td><?php echo esc_html(intval($row->csr_fund)); ?></td>
                        <td><?php echo esc_html(intval($row->expenditure)); ?></td>
                        <td><?php echo esc_html($row->status); ?></td>
                        <td><?php echo esc_html($row->work_category); ?></td>
                        <td><?php echo esc_html($row->date_sanctioned); ?></td>
                        <td><?php echo esc_html($row->executive_agency); ?></td>
                        <td><a href="<?php echo esc_url(add_query_arg('action', 'edit', add_query_arg('csr_id', $row->csr_id, home_url('/edit-csr')))); ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            echo paginate_links([
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total' => $total_pages,
                'current' => $current_page,
                'format' => '?paged=%#%',
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
                'type' => 'list',
            ]);
            ?>
        </div>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
