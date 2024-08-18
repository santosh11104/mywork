<?php

class CSR_Import {
    private static $instance = null;

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_menu', [$this, 'add_import_page']);
    }

    public function add_import_page() {
        add_menu_page(
            'CSR Import',
            'CSR Import',
            'manage_options',
            'csr-import',
            [$this, 'create_import_page'],
            'dashicons-upload'
        );
    }

    public function create_import_page() {
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
            // Validate required fields
            $errors = $this->validate_row($row);
            if (!empty($errors)) {
                echo '<div class="notice notice-error is-dismissible"><p>' . implode('<br>', $errors) . '</p></div>';
                continue;
            }

            // Map each CSV field to its respective table.
            $company_id = $this->get_mapped_id($wpdb, 'wp_companies', $row['company']);
            $constituency_id = $this->get_mapped_id($wpdb, 'wp_constituencies', $row['constituency']);
            $work_category_id = $this->get_mapped_id($wpdb, 'wp_work_categories', $row['work_category']);
            $department_id = $this->get_mapped_id($wpdb, 'wp_departments', $row['department']);

            // Insert data into the database
            $wpdb->insert('wp_csr_submissions', [
                'id' => $row['id'],
                'company_id' => $company_id,
                'funding_year' => $row['funding_year'],
                'constituency_id' => $constituency_id,
                'mandal' => $row['mandal'],
                'village' => $row['village'],
                'name_of_work' => $row['name_of_work'],
                'csr_fund' => $row['csr_fund'],
                'expenditure' => $row['expenditure'],
                'status' => $row['status'],
                'work_category_id' => $work_category_id,
                'date_sanctioned' => $row['date_sanctioned'],
                'executive_agency' => $row['executive_agency'],
                'department_id' => $department_id
            ]);
        }

        echo '<div class="notice notice-success is-dismissible"><p>Data Imported Successfully!</p></div>';
    }

    private function validate_row($row) {
        $errors = [];
    
        // Required fields validation
        $required_fields = [
            'id', 'company_id', 'funding_year', 'constituency', 'mandal', 
            'village', 'name_of_work', 'csr_fund', 'expenditure', 'status', 
            'work_category_id', 'date_sanctioned', 'executive_agency', 'department_id'
        ];
       

        foreach ($required_fields as $field) {
            if (empty($row[$field])) {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }
    
        // Numeric validation for fund and expenditure
        if (!empty($row['csr_fund']) && !is_numeric($row['csr_fund'])) {
            $errors[] = 'CSR Fund must be a valid number.';
        }
    
        if (!empty($row['expenditure']) && !is_numeric($row['expenditure'])) {
            $errors[] = 'Expenditure must be a valid number.';
        }
    
        // Date validation for date_sanctioned
        if (!empty($row['date_sanctioned']) && !$this->validate_date_format($row['date_sanctioned'], 'd-m-Y')) {
            $errors[] = 'Date Sanctioned must be a valid date in the format dd-mm-yyyy.';
        }
    
        return $errors;
    }

    private function process_row($wpdb, $row) {
        // Convert and map company_id, work_category_id, and department_id
        $row['company_id'] = $this->get_mapped_id($wpdb, 'wp_companies', $row['company_id']);
        $row['work_category_id'] = $this->get_mapped_id($wpdb, 'wp_work_categories', $row['work_category_id']);
        $row['department_id'] = $this->get_mapped_id($wpdb, 'wp_departments', $row['department_id']);
        
        // Convert date_sanctioned to YYYY-MM-DD
        $row['date_sanctioned'] = $this->convert_date_format($row['date_sanctioned'], 'd-m-Y', 'Y-m-d');
        
        // Insert the row into the database
        $wpdb->insert('wp_csr_submissions', $row);
    }
    
    private function validate_date_format($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
    
    private function convert_date_format($date, $from_format = 'd-m-Y', $to_format = 'Y-m-d') {
        $d = DateTime::createFromFormat($from_format, $date);
        return $d ? $d->format($to_format) : false;
    }
}
