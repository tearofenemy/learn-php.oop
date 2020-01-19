<?php include("includes/init.php"); ?>
<?php 
    if(!$session->signedIn()){
        redirect("login.php");
    }

    if(empty($_GET['id'])){
        redirect("users.php");
    } else {
        $user = User::find_by_id($_GET['id']);

        if($user){
            $user->delete();
            echo "User successfully deleted." . "<br>" . "<a href='users.php'>Back to users table</a>";
        } else {
            redirect('users.php');
        }
    }


?>