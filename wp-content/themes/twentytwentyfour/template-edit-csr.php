<?php
/* Template Name: Edit CSR */
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

get_header(); ?>

<div class="container">
    <h1>Edit CSR Submission</h1>

    <?php
    
   

    global $wpdb;
    $table_name = $wpdb->prefix . 'csr_submissions';
    $constituencies_table = $wpdb->prefix . 'constituencies';

    // Get record ID from URL
    $record_id = isset($_GET['csr_id']) ? intval($_GET['csr_id']) : 0;

    if ($record_id) {
        $submission = $wpdb->get_row($wpdb->prepare("
            SELECT 
                submissions.csr_id,
                submissions.id,
                submissions.company,
                submissions.funding_from,
                submissions.funding_till,
                submissions.constituency_id,
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
            WHERE 
                submissions.csr_id = %d
        ", $record_id));

        if ($submission) {
            $years = range(1950, 2100);
            $yearOptionsFrom = '';
            $yearOptionsTill = '';
            foreach ($years as $year) {
                $yearOptionsFrom .= "<option value='{$year}'" . selected($submission->funding_from, $year, false) . ">{$year}</option>";
                $yearOptionsTill .= "<option value='{$year}'" . selected($submission->funding_till, $year, false) . ">{$year}</option>";
            }

            $workCategories = [
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
            ];
            $workCategoryOptions = '<option value="" disabled selected>Please select</option>';
            foreach ($workCategories as $category) {
                $workCategoryOptions .= "<option value='{$category}'" . selected($submission->work_category, $category, false) . ">{$category}</option>";
            }

            $statusOptions = [
                'Pending',
                'In Progress',
                'Completed',
                'Cancelled'
            ];
            $statusDropdownOptions = '<option value="" disabled selected>Please select</option>';
            foreach ($statusOptions as $status) {
                $statusDropdownOptions .= "<option value='{$status}'" . selected($submission->status, $status, false) . ">{$status}</option>";
            }

            $constituencyOptions = '';
            $constituencyResults = $wpdb->get_results("SELECT id, name FROM $constituencies_table");
            foreach ($constituencyResults as $constituency) {
                $constituencyOptions .= "<option value='{$constituency->id}'" . selected($submission->constituency_id, $constituency->id, false) . ">{$constituency->name}</option>";
            }
            ?>

            <form id="editCSRForm" method="POST" action="<?php echo esc_url(admin_url('admin-post.php?action=update_csr_form')); ?>" style="max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                <input type="hidden" name="record_id" value="<?php echo esc_attr($record_id); ?>">

                <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 300px; margin-right: 20px;">
                        <label for="company" style="display: block; margin-bottom: 8px; font-weight: bold;">Company:</label>
                        <input type="text" id="company" name="company" value="<?php echo esc_attr($submission->company); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="funding_from" style="display: block; margin-bottom: 8px; font-weight: bold;">Funding From:</label>
                        <select id="funding_from" name="funding_from" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $yearOptionsFrom; ?>
                        </select>

                        <label for="funding_till" style="display: block; margin-bottom: 8px; font-weight: bold;">Funding Till:</label>
                        <select id="funding_till" name="funding_till" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $yearOptionsTill; ?>
                        </select>

                        <label for="id" style="display: block; margin-bottom: 8px; font-weight: bold;">IDS:</label>
                        <input type="number" id="id" name="id" value="<?php echo esc_attr($submission->id); ?>"  required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="constituency" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency:</label>
                        <select id="constituency" name="constituency" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $constituencyOptions; ?>
                        </select>

                        <label for="mandal" style="display: block; margin-bottom: 8px; font-weight: bold;">Mandal:</label>
                        <input type="text" id="mandal" name="mandal" value="<?php echo esc_attr($submission->mandal); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="village" style="display: block; margin-bottom: 8px; font-weight: bold;">Village:</label>
                        <input type="text" id="village" name="village" value="<?php echo esc_attr($submission->village); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    </div>

                    <div style="flex: 1; min-width: 300px;">
                        <label for="name_of_work" style="display: block; margin-bottom: 8px; font-weight: bold;">Name of Work:</label>
                        <input type="text" id="name_of_work" name="name_of_work" value="<?php echo esc_attr($submission->name_of_work); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="csr_fund" style="display: block; margin-bottom: 8px; font-weight: bold;">CSR Fund:</label>
                        <input type="number"   id="csr_fund" name="csr_fund" value="<?php echo esc_attr(intval($submission->csr_fund)); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="expenditure" style="display: block; margin-bottom: 8px; font-weight: bold;">Expenditure:</label>
                        <input type="number"   id="expenditure" name="expenditure" value="<?php echo esc_attr(intval($submission->expenditure)); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="status" style="display: block; margin-bottom: 8px; font-weight: bold;">Status:</label>
                        <select id="status" name="status" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $statusDropdownOptions; ?>
                        </select>

                        <label for="work_category" style="display: block; margin-bottom: 8px; font-weight: bold;">Work Category:</label>
                        <select id="work_category" name="work_category" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $workCategoryOptions; ?>
                        </select>

                        <label for="date_sanctioned" style="display: block; margin-bottom: 8px; font-weight: bold;">Date Sanctioned:</label>
                        <input type="date" id="date_sanctioned" name="date_sanctioned" value="<?php echo esc_attr($submission->date_sanctioned); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="executive_agency" style="display: block; margin-bottom: 8px; font-weight: bold;">Executive Agency:</label>
                        <input type="text" id="executive_agency" name="executive_agency" value="<?php echo esc_attr($submission->executive_agency); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    </div>
                </div>

                <div style="text-align: right;">
                    <input type="submit" value="Update" style="padding: 10px 20px; background-color: #0073aa; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
                </div>
            </form>

            <?php
        } else {
            echo "<p>Invalid CSR Submission ID.</p>";
        }
    } else {
        echo "<p>No CSR Submission ID provided.</p>";
    }
    ?>
</div>

<?php get_footer(); ?>
