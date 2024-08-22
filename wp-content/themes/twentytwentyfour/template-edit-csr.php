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
    $companies_table = $wpdb->prefix . 'companies';
    $departments_table = $wpdb->prefix . 'departments';
    $workcategories_table = $wpdb->prefix . 'workcategories';
    $mandals_table = $wpdb->prefix . 'mandals';

    // Get record ID from URL
    $record_id = isset($_GET['csr_id']) ? intval($_GET['csr_id']) : 0;

    if ($record_id) {
        $submission = $wpdb->get_row($wpdb->prepare("
            SELECT 
                submissions.csr_id,
                submissions.id,
                submissions.company_id as company_id,
                submissions.funding_year,
                submissions.department_id as department_id,
                submissions.constituency_id as constituency_id,
                submissions.work_category_id as work_category_id,
                submissions.mandal_id as mandal_id,
                submissions.village,
                submissions.name_of_work,
                submissions.csr_fund,
                submissions.expenditure,
                submissions.status,
                submissions.date_sanctioned,
                submissions.executive_agency
            FROM 
                $table_name AS submissions
            WHERE 
                submissions.csr_id = %d
        ", $record_id));
      //  echo $wpdb->last_query;

        if ($submission) {
            $years = range(1950, 2100);
            $yearOptionsFrom = '';
            foreach ($years as $year) {
                $yearOptionsFrom .= "<option value='{$year}'" . selected($submission->funding_year, $year, false) . ">{$year}</option>";
            }

          

            $statusOptions = [
                'Completed',
                'In Progress',
                'Not Started',
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

            $companyOptions = '';
            $companyResults = $wpdb->get_results("SELECT id, name FROM $companies_table");
            foreach ($companyResults as $company) {
                $companyOptions .= "<option value='{$company->id}'" . selected($submission->company_id, $company->id, false) . ">{$company->name}</option>";
            }

            $departmentOptions = '';
            $departmentResults = $wpdb->get_results("SELECT id, name FROM $departments_table");
            foreach ($departmentResults as $department) {
                $departmentOptions .= "<option value='{$department->id}'" . selected($submission->department_id, $department->id, false) . ">{$department->name}</option>";
            }

            $workCategoryOptions = '';
            $workcategoryResults = $wpdb->get_results("SELECT id, name FROM $workcategories_table");
            foreach ($workcategoryResults as $workcategory) {
                $workCategoryOptions .= "<option value='{$workcategory->id}'" . selected($submission->workcategory_id, $workcategory->id, false) . ">{$workcategory->name}</option>";
            }
            $mandalOptions = '';
            $mandalResults = $wpdb->get_results("SELECT id, name FROM $mandals_table");
            foreach ($mandalResults as $mandal) {
                $mandalOptions .= "<option value='{$mandal->id}'" . selected($submission->mandal_id, $mandal->id, false) . ">{$mandal->name}</option>";
            }
    ?>

            <form id="editCSRForm" method="POST" action="<?php echo esc_url(admin_url('admin-post.php?action=update_csr_form')); ?>" style="max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                <input type="hidden" name="record_id" value="<?php echo esc_attr($record_id); ?>">

                <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 300px; margin-right: 20px;">
                        <label for="company" style="display: block; margin-bottom: 8px; font-weight: bold;">Company:</label>
                        <select id="company" name="company" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $companyOptions; ?>
                        </select>
                        <label for="department" style="display: block; margin-bottom: 8px; font-weight: bold;">Department:</label>
                        <select id="department" name="department" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $departmentOptions; ?>
                        </select>

                        <label for="funding_year" style="display: block; margin-bottom: 8px; font-weight: bold;">Funding From:</label>
                        <input type="text" id="funding_year" name="funding_year" value="<?php echo esc_attr($submission->funding_year); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="id" style="display: block; margin-bottom: 8px; font-weight: bold;">IDS:</label>
                        <input type="number" id="id" name="id" value="<?php echo esc_attr($submission->id); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="constituency" style="display: block; margin-bottom: 8px; font-weight: bold;">Constituency:</label>
                        <select id="constituency" name="constituency" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $constituencyOptions; ?>
                        </select>

                        
                        <label for="mandal" style="display: block; margin-bottom: 8px; font-weight: bold;">Mandals:</label>
                        <select id="mandal" name="mandal" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                            <?php echo $mandalOptions; ?>
                        </select>

                        <label for="village" style="display: block; margin-bottom: 8px; font-weight: bold;">Village:</label>
                        <input type="text" id="village" name="village" value="<?php echo esc_attr($submission->village); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                    </div>

                    <div style="flex: 1; min-width: 300px;">
                        <label for="name_of_work" style="display: block; margin-bottom: 8px; font-weight: bold;">Name of Work:</label>
                        <input type="text" id="name_of_work" name="name_of_work" value="<?php echo esc_attr($submission->name_of_work); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="csr_fund" style="display: block; margin-bottom: 8px; font-weight: bold;">CSR Fund:</label>
                        <input type="number" id="csr_fund" name="csr_fund" value="<?php echo esc_attr(intval($submission->csr_fund)); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                        <label for="expenditure" style="display: block; margin-bottom: 8px; font-weight: bold;">Expenditure:</label>
                        <input type="number" id="expenditure" name="expenditure" value="<?php echo esc_attr(intval($submission->expenditure)); ?>" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

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