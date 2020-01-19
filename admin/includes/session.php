<?php 

class Session
{

    private $signed_in = false;
    public $user_id;
    public $message;
    public $count = 0;

    public function __construct()
    {
        session_start();
        $this->checkLogin();
        $this->visitor_count();
        $this->checkMessage();
    }

    public function visitor_count()
    {
        if (isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }


    public function signedIn()
    {
        return $this->signed_in;
    }

    public function login($user)
    {
        if ($user) {
            $this->signed_in = true;
            $this->user_id = $_SESSION['user_id'] = $user->id;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }

    private function checkLogin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->signed_in = true;
            $this->user_id = $_SESSION['user_id'];
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function message($msg = '')
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}

$session = new Session();

?>