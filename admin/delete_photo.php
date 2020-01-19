<?php include("includes/init.php"); ?>

    <?php
        if(!$session->signedIn()){
            redirect('login.php');
        }
    ?>

    <?php 
        if(empty($_GET['id'])){
            redirect('../photo.php');
        }

        $photo = Photo::find_by_id($_GET['id']);

        if($photo){
            $photo->delete_photo();
            echo "This Picture successfully deleted" . "<p>" . "<a href='photo.php'>Back to all photos.</a>";
        } else {
            redirect('../photo.php');
        }

    ?>