<?php

    class DB_OBJECT {

        public static function find_all(){
            return static::find_query("SELECT * FROM " . static::$db_table);
        }
    
        public static function find_by_id($id){
    
            $result = static::find_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
            if($result){
                return array_shift($result);
            } else {
                return false;
            }
        }

        public static function instantation($record){

            $class_calling = get_called_class();
            $obj = new $class_calling;
            foreach($record as $attribute => $value){
                if($obj->has_attribute($attribute)){
                    $obj->$attribute = $value;
                }
            }
            return $obj;
        }
        
        private function has_attribute($attr){
            $objArr = get_object_vars($this);
            return array_key_exists($attr, $objArr);
        }
    
        public static function find_query($sql){
            global $db;
    
            $result = $db->query($sql);
            $objArray = array();
            while($row = mysqli_fetch_array($result)){
                $objArray[] = static::instantation($row);
            }
            return $objArray;
        }
        
        protected function properties(){
            $properties = array();
            foreach(static::$db_field as $field){
                if(property_exists($this, $field)){
                    $properties[$field] = $this->$field;
                }
            }
            return $properties;
        }
    
        protected function clean_prop(){
            global $db;
    
            $clean_prop = array();
            foreach($this->properties() as $key => $value){
                $clean_prop[$key] = $db->escape_string($value);
            }
            return $clean_prop;
        }
    
        
        public function save(){
            if(isset($this->id)){
                $this->update();
            } else {
                $this->create();
            }
        }
    
        public function create(){
            global $db;
    
            $prop = $this->clean_prop();
    
            $sql = "INSERT INTO " . static::$db_table . "(" . implode(',', array_keys($prop)) . ") VALUES('" . implode("','", array_values($prop)) . "')";
    
            if($db->query($sql)){
                $this->id = $db->insertID();
                return true;
            } else {
                return false;
            }
        }
    
        public function update(){
            global $db;

            $prop = $this->clean_prop();    
            $prop_pairs = array();
    
            foreach($prop as $key => $value){
                $prop_pairs[] = "{$key} = '{$value}'"; 
            }

            $sql = "UPDATE " . static::$db_table . " SET " . implode(", ", $prop_pairs)  . " WHERE id = '{$db->escape_string($this->id)}'";
            $db->query($sql);
            return (mysqli_affected_rows($db->connect) == 1) ? true : false;
        }
    
        public function delete(){
            global $db;
    
            $sql = "DELETE FROM " . static::$db_table . " WHERE id = '{$db->escape_string($this->id)}' LIMIT 1";
            $db->query($sql);
            return (mysqli_affected_rows($db->connect) == 1) ? true : false;
        }

        public static function count_all(){
            global $db;
            $sql = "SELECT COUNT(*) FROM " . static::$db_table . "";
            $res = $db->query($sql);
            $row = mysqli_fetch_array($res);
            return array_shift($row);
        }

    }

    $dbObj = new DB_OBJECT();
?>