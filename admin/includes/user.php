<?php 
require_once("db_obj.php");

class User extends DB_OBJECT {

    protected static $db_table = "users";
    protected static $db_field = array('id', 'avatar', 'login', 'password', 'firstName', 'lastName');
    public $id;
    public $avatar;
    public $login;
    public $firstName;
    public $lastName;
    public $password;
    public $tmp_path;
    public $upload_dir = "images/user_avatar";
    public $img_placeholder = "http://placehold.it/40x40";
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
            $this->avatar = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
        }
        
    }

    public function save_user(){
        if(!empty($this->custom_errors)){
            return false;
        }

        if(empty($this->avatar) || empty($this->tmp_path)){
            $this->custom_errors[] = 'The file was not avaible';
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->avatar;

        if(file_exists($target_path)){
            $this->custom_errors[] = "The file '{$this->avatar}' already exists";
            return false;
        }

        if(move_uploaded_file($this->tmp_path, $target_path)){
            unset($this->tmp_path);
            return true;
        } else {
            $this->custom_errors[] = "The folder probably does not permission";
            return false;
        }
    }


    public static function verify_user($login, $pass){
        global $db;

        $login = $db->escape_string($login);
        $pass = md5($db->escape_string($pass));

        $result = self::find_query("SELECT * FROM " . self::$db_table . " WHERE login = '{$login}' AND password = '{$pass}'");

        if(!empty($result)){
            return array_shift($result);
        } else {
            return false;
        }
    }

    public function user_avatar(){
        return empty($this->avatar) ? $this->img_placeholder : $this->upload_dir . DS . $this->avatar;
    }

}

?>