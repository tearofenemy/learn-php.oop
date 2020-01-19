<?php include("includes/header.php"); ?>

<?php if(!$session->signedIn()) redirect("login.php"); ?>

<?php 

    if(empty($_GET['id'])){
        redirect("photos.php");
    }

    $comments = Comment::find_comments($_GET['id']);

?> 
          
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?> 
           
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comments
                        </h1>
                        <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <?php foreach($comments as $comment): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $comment->id ?></td>
                                        <td><?= $comment->author ?></td>
                                        <td><?= $comment->body ?></td>
                                        <td class="action">
                                            <a href="delete_comment.php?id=<?= $comment->id ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                    </div>
                </div>
            </div>

        </div>
        

  <?php include("includes/footer.php"); ?>