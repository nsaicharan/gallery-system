<?php 

    require_once('config.php');

    class Database {

        public $connection;

        function __construct() {
            $this->open_db_connection();
        }

        public function open_db_connection() {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->connection->connect_errno) {
                die("Database connection error: " . $this->connection->connect_error);
            }
        }

        public function query($sql) {
            $result = $this->connection->query($sql);
            
            $this->confirm_query($result);
            
            return $result;
        }

        private function confirm_query($result) {
            if (!$result) {
                die("Query failed! " . $this->connection->error);
            }
        }

        public function esc_string($str) {
            return $this->connection->real_escape_str($str);
        }

    }

    $database = new Database();

?>