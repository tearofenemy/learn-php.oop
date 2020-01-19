<?php 

    class Comment extends DB_OBJECT {

        protected static $db_table = "comments";
        protected static $db_field = array("id", "photo_id", "author", "body", "created_at");
        public $id;
        public $photo_id;
        public $author;
        public $body;
        public $created_at;

        public static function create_comment($photo_id, $author, $body, $created_at){

            if(!empty($photo_id) && !empty($author) && !empty($body)){
                $comment = new Comment();
                $comment->photo_id = (int)$photo_id;
                $comment->author = $author;
                $comment->body = $body;
                $comment->created_at = $created_at;
                $comment->save();
                refresh(0);
            } else {
                return false;
            }
        }

        public static function find_comments($photo_id = 0){
            global $db;
            $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $db->escape_string($photo_id) . " ORDER BY photo_id ASC";
            return self::find_query($sql);
        }

    }

?>