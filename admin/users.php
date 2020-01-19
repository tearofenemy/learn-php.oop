<?php include("includes/header.php"); ?>

        <?php
            if(!$session->signedIn()){
                redirect('login.php');
            }
            $users= User::find_all();
        ?>
          
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?> 
           
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-12">
                    
                        <h1 class="page-header">Users  <a href="add_user.php" class="btn btn-primary">Add User</a></h1>
                       
                        <div class="col-md-12">
                           
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Avatar</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <?php foreach($users as $user): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $user->id ?></td>
                                        <td><img src="<?= $user->user_avatar() ?>" class="admin_table_photo__users"></td>
                                        <td><?= $user->login ?></td>
                                        <td><?= $user->firstName ?></td>
                                        <td><?= $user->lastName ?></td>
                                        <td class="action">
                                            <a href="#"><i class="fa fa-eye"></i></a>
                                            <a href="edit_user.php?id=<?= $user->id ?>"><i class="fa fa-edit"></i></a>
                                            <a href="delete_user.php?id=<?= $user->id ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        

  <?php include("includes/footer.php"); ?>