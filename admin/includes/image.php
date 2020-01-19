<?php 

    class Photo extends DB_OBJECT {

        protected static $db_table = "photo";
        protected static $db_field = array("id", "title", "caption", "description", "author", "created_at", "fileName", "alt_text", "type", "size");
        public $id;
        public $title;
        public $caption;
        public $description;
        public $author;
        public $created_at;
        public $fileName;
        public $alt_text;
        public $type;
        public $size;

        public $tmp_path;
        public $upload_dir = "images";
        public $custom_errors = array();
        public $upload_errors = array(
            UPLOAD_ERR_OK => "There is no error",
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive...",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that...",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
            UPLOAD_ERR_NO_FILE => "No file was uploaded",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
        );


        public function set_file($file){

            if(empty($file) || !$file || !is_array($file)){
                $this->custom_errors[] = "There was no file uploaded here";
                return false;

            } else if($file['error'] != 0){
                $this->custom_errors[] = $this->upload_errors[$file['error']];
                return false;

            } else {
                $this->fileName = basename($file['name']);
                $this->tmp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }
            
        }

        public function image_path(){
            return $this->upload_dir . DS . $this->fileName;
        }

        public function update_photo(){
            if($this->update()){
                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->fileName;
                unlink($target_path);
                if(move_uploaded_file($this->tmp_path, $target_path)){
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function save(){
            if($this->id){
                $this->update_photo();
                $this->update();
            } else {
                if(!empty($this->custom_errors)){
                    return false;
                }

                if(empty($this->fileName) || empty($this->tmp_path)){
                    $this->custom_errors[] = 'The file was not avaible';
                    return false;
                }

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->fileName;

                if(file_exists($target_path)){
                    $this->custom_errors[] = "The file '{$this->fileName}' already exists";
                    return false;
                }

                if(move_uploaded_file($this->tmp_path, $target_path)){
                    if($this->create()){
                        unset($this->tmp_path);
                        return true;
                    }
                } else {
                    $this->custom_errors[] = "The folder probably does not permission";
                    return false;
                }
            }
        }

        public function delete_photo(){
            if($this->delete()){
                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->image_path();
                return unlink($target_path) ? true : false;
            } else {
                return false;
            }

        }

        public function search($query){
            global $db;

            $sql = "SELECT * FROM " . self::$db_table . " WHERE title LIKE '%" . trim($query) . "%' ";            
            $result = $db->query($sql);
            $objArr = array();
            while($row = mysqli_fetch_array($result)){
                $objArr[] = self::instantation($row);
            }
            return $objArr;
        }
    }
?>