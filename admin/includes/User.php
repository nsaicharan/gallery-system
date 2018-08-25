<?php 

    class User {

        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;

        public static function find_all_users() {
            return self::find_this_query("SELECT * FROM users");
        }

        public static function find_user_by_id($user_id) {
            $result = self::find_this_query("SELECT * FROM users WHERE id = $user_id");

            return !empty($result) ? array_shift($result) : false; //Returns either first item in the array or false
        }

        public static function find_this_query($sql) {
            global $database;
            
            $result = $database->query($sql);

            $the_object_array = array();

            while($row = mysqli_fetch_array($result)) {
               $the_object_array[] = self::instantiation($row);
            }

            return $the_object_array;
        }
 
        public static function instantiation($user_row) {
            $the_object = new self();

            foreach ($user_row as $key => $value) {
                if ($the_object->has_property($key)) {
                    $the_object->$key = $value;
                }
            }

            return $the_object;
        }

        private function has_property($property) {
            $object_properties = get_object_vars($this);

            return array_key_exists($property, $object_properties);
        }
        
    }

?>