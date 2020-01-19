<?php 

if(defined("DS")){
    return null;
} else {
    define("DS", DIRECTORY_SEPARATOR);
}

if(defined("SITE_ROOT")){
    return null;
} else {
    define("SITE_ROOT", 'C:' . DS . 'OSPanel' . DS . 'domains' . DS . 'learn-php.oop');
}

if(defined("INCLUDES_PATH")){
    return null;
} else {
    define("INCLUDES_PATH", SITE_ROOT . DS . 'admin'. DS. 'includes');
}

require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."db.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."session.php");
require_once(INCLUDES_PATH.DS."db_obj.php");
require_once(INCLUDES_PATH.DS."image.php");
require_once(INCLUDES_PATH.DS."comment.php");
require_once(INCLUDES_PATH.DS."paginate.php");

?>