<?php

class DB_Handler {
    
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function get_all_rows($table_name) {
        $query = "SELECT * FROM {$this->wpdb->prefix}{$table_name}";
        return $this->wpdb->get_results($query);
    }

    public function insert_row($table_name, $data) {
        return $this->wpdb->insert("{$this->wpdb->prefix}{$table_name}", $data);
    }

    // Otros métodos para actualizar, eliminar, etc.
}

?>
