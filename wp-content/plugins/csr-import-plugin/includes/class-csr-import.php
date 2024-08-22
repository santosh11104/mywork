<?php
class CSR_Import
{
    private static $instance = null;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action('admin_menu', [$this, 'add_import_page']);
    }

    public function add_import_page()
    {
        add_menu_page(
            'CSR Import',
            'CSR Import',
            'manage_options',
            'csr-import',
            [$this, 'create_import_page'],
            'dashicons-upload'
        );
    }

    public function create_import_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
            $file = $_FILES['csv_file']['tmp_name'];
            if ($file) {
                $this->import_csv($file);
            }
        }

        echo '<div class="wrap">';
        echo '<h1>Import CSR Data</h1>';
        echo '<form method="POST" enctype="multipart/form-data">';
        echo '<input type="file" name="csv_file" />';
        echo '<input type="submit" class="button-primary" value="Import" />';
        echo '</form>';
        echo '</div>';
    }

    private function import_csv($file) {
        require_once plugin_dir_path(__FILE__) . 'csv-reader.php';
        $csv = new CSV_Reader($file);
        $data = $csv->get_data();
    
        global $wpdb;
    
        foreach ($data as $row) {
            // Normalize keys to lowercase and trim spaces
            $row = array_change_key_case(array_map('trim', $row), CASE_LOWER);
    
            // Escape special characters
            $row = array_map([$this, 'escape_special_chars'], $row);
    
            // Validate required fields
            $errors = $this->validate_row($row);
            if (!empty($errors)) {
                echo '<div class="notice notice-error is-dismissible"><p>' . implode('<br>', $errors) . '</p></div>';
                continue;
            }
    
            // Map each CSV field to its respective table
            $company_id = $this->get_mapped_id($wpdb, 'wp_companies', $row['company']);
            $constituency_id = $this->get_mapped_id($wpdb, 'wp_constituencies', $row['constituency']);
            $work_category_id = $this->get_mapped_id($wpdb, 'wp_workcategories', $row['workcategory']);
            $department_id = $row['department'] ? $this->get_mapped_id($wpdb, 'wp_departments', $row['department']) : null;
            $mandal_id = $row['mandal'] ? $this->get_mapped_id($wpdb, 'wp_mandals', $row['mandal']) : null;

            $current_user_id = get_current_user_id();
            $date_parts = explode('/', $row['date_sanctioned']); // Splitting the date by "-"

            if (count($date_parts) === 3) {
                $date_sanctioned = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
            }
            // Insert data into the database
            $result = $wpdb->insert('wp_csr_submissions', [
                'id' => $row['id'],
                'company_id' => $company_id,
                'funding_year' => $row['funding_year'],
                'constituency_id' => $constituency_id,
                'mandal' => $mandal_id,
                'village' => $row['village'],
                'name_of_work' => $row['name_of_work'],
                'csr_fund' => $row['csr_fund'],
                'expenditure' => $row['expenditure'],
                'status' => $row['status'],
                'work_category_id' => $work_category_id,
                'date_sanctioned' => $date_sanctioned,
                'executive_agency' => $row['executive_agency'],
                'department_id' => $department_id,
                'createdBy' => $current_user_id,
                'modifiedBy' => $current_user_id
            ]);
    
            if ($result === false) {
                // Display an error message with the ID of the failed row
                echo '<div class="notice notice-error is-dismissible"><p>Failed to insert data for row with ID: ' . $row['id'] . '</p></div>';
            }
        }
    
        echo '<div class="notice notice-success is-dismissible"><p>Data Imported Successfully!</p></div>';
    }
    
    

    private function escape_special_chars($value)
    {
        global $wpdb;
        // Escapes single quotes and other special characters
        return $wpdb->_escape($value);
    }

    private function validate_row($row) {
        $errors = [];
    
        if (empty($row['company'])) {
            $errors[] = 'Company is required.';
        }
        if (empty($row['department'])) {
            $errors[] = 'Department is required.';
        }
    
        $required_fields = [
            'company', 'workcategory', 'department', 'executive_agency', 'name_of_work', 
            'funding_year', 'id', 'constituency', 'mandal', 'village', 
            'date_sanctioned', 'status'
        ];
    
        foreach ($required_fields as $field) {
            if (!isset($row[$field]) || trim($row[$field]) === '') {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }
    
        // Check if csr_fund is empty or invalid, and set it to 0 if empty
        if (!isset($row['csr_fund']) || trim($row['csr_fund']) === '') {
            $row['csr_fund'] = 0;
        } elseif (!is_numeric($row['csr_fund']) || $row['csr_fund'] < 0) {
            $errors[] = 'CSR Fund must be a valid number and cannot be less than 0.';
        }
    
        // Check if expenditure is empty or invalid, and set it to 0 if empty
        if (!isset($row['expenditure']) || trim($row['expenditure']) === '') {
            $row['expenditure'] = 0;
        } elseif (!is_numeric($row['expenditure']) || $row['expenditure'] < 0) {
            $errors[] = 'Expenditure must be a valid number and cannot be less than 0.';
        }
    
        if (!empty($row['date_sanctioned']) && !$this->validate_date_format($row['date_sanctioned'], 'd/m/Y')) {
            $errors[] = 'The Date Sanctioned must be a valid date in the format dd/mm/yyyy in the uploaded file with ID '. $row['id'];
        }
    
        return $errors;
    }
    

    private function validate_date_format($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    private function get_mapped_id($wpdb, $table, $value)
    {
        $id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE name = %s", $value));
        if (!$id) {
            echo '<div class="notice notice-error is-dismissible"><p>No matching record found in ' . $table . ' for value: ' . $value . '</p></div>';
        }
        return $id;
    }
}
