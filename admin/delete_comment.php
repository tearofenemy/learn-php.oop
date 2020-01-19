<?php include("includes/init.php"); ?>
<?php 
    if(!$session->signedIn()){
        redirect("login.php");
    }

    if(empty($_GET['id'])){
        redirect("users.php");
    } else {
        $comment = Comment::find_by_id($_GET['id']);

        if($comment){
            $comment->delete();
            echo "Comment successfully deleted." . "<br>" . "<a href='comments.php'>Back to comments table</a>";
        } else {
            redirect('comments.php');
        }
    }


?>