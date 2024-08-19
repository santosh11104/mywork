<?php

class CSV_Reader {
    private $file;
    private $data;

    public function __construct($file) {
        $this->file = $file;
        $this->data = $this->parse_csv();
    }

    public function get_data() {
        return $this->data;
    }

    private function parse_csv() {
        $rows = [];
        if (($handle = fopen($this->file, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE) {
                $rows[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $rows;
    }
}

