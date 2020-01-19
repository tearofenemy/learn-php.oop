<?php include("includes/header.php"); ?>

        <?php
            if(!$session->signedIn()){
                redirect('login.php');
            }
            $photos = Photo::find_all();
        ?>
          
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?> 
           
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Photos
                            <small>Subheading</small>
                        </h1>

                        <div class="col-md-12">
                           
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Caption</th>
                                        <th>Description</th>
                                        <th>Author</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <?php foreach($photos as $photo): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $photo->id ?></td>
                                        <td><img src="<?= $photo->image_path() ?>" alt="<?= $photo->alt_text ?>" class="admin_table_photo"></td>
                                        <td><?= $photo->title ?></td>
                                        <td><?= $photo->caption ?></td>
                                        <td><?= $photo->description ?></td>
                                        <td><?= $photo->author ?></td>
                                        <td><?= substr($photo->size, 0, 3) . " KB" ?></td>
                                        <td>
                                            <a href="comment_photo.php?id=<?= $photo->id ?>">
                                                <?php $comments = Comment::find_comments($photo->id); 
                                                    echo count($comments);?>
                                            </a>
                                        </td>
                                        <td class="action">
                                            <a href="../photo.php?id=<?= $photo->id ?>"><i class="fa fa-eye"></i></a>
                                            <a href="edit_photo.php?id=<?= $photo->id ?>"><i class="fa fa-edit"></i></a>
                                            <a href="delete_photo.php?id=<?= $photo->id ?>"><i class="fa fa-remove"></i></a>
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