<?php include("includes/header.php"); ?>

        <?php
            if(!$session->signedIn()){
                redirect('login.php');
            }
        ?>

        <?php

            if(empty($_GET['id'])){
                redirect("users.php");
            }
    
            $user = User::find_by_id($_GET['id']);
            if(isset($_POST['submit'])){
                if($user){
                    $user->login = trim($_POST['login']);
                    $user->firstName = trim($_POST['first_name']);
                    $user->lastName = trim($_POST['last_name']);
                    $user->password = md5(trim($_POST['password']));
                    
                    if(empty($_FILES['avatar'])){
                        $user->save();
                    } else {
                        $user->set_file($_FILES['avatar']);
                        $user->save_user();
                        $user->save();
                        redirect("users.php");
                    }
                } else {
                    return false;
                }
            }

        ?>
          
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?> 
           
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">         
                <div class="row">
                <h1 class="page-header">Edit User: <?= $user->firstName ?> <?= $user->lastName ?> </h1>
                    <div class="col-lg-12">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-7">

                                 <div class="form-group">
                                    <label for="login">Avatar</label>
                                    <input type="file" name="avatar">
                                </div>

                                <div class="form-group">
                                    <label for="login">User Name</label>
                                    <input type="text" name="login" class="form-control" value="<?= $user->login ?>">
                                </div>

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?= $user->firstName ?>">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?= $user->lastName ?>">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" value="Update User" class="btn btn-success">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <img src="<?= $user->user_avatar() ?>" class="edit_user_avatar">
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        

  <?php include("includes/footer.php"); ?>