<?php include("includes/header.php"); ?>

        <?php
            if(!$session->signedIn()){
                redirect('login.php');
            }
        ?>

        <?php
            $user = new User();
            if(isset($_POST['submit'])){
                if($user){
                    $user->login = $_POST['login'];
                    $user->firstName = $_POST['first_name'];
                    $user->lastName = $_POST['last_name'];
                    $user->password = md5($_POST['password']);
                    $user->set_file($_FILES['avatar']);
                    $user->save_user();
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
                <h1 class="page-header">Add User</h1>
                    <div class="col-lg-12">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-8">

                                 <div class="form-group">
                                    <label for="login">Avatar</label>
                                    <input type="file" name="avatar">
                                </div>

                                <div class="form-group">
                                    <label for="login">User Name</label>
                                    <input type="text" name="login" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">LastName</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add User" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        

  <?php include("includes/footer.php"); ?>