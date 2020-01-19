<?php include("includes/header.php"); ?>

        <?php
            if(!$session->signedIn()){
                redirect('login.php');
            }
        ?>

        <?php

            if(empty($_GET['id'])){
                redirect("photos.php");
            } 

            $photo = Photo::find_by_id($_GET['id']);
            if(isset($_POST['update'])){
                if($photo){
                    $photo->title = $_POST['title'];
                    $photo->caption = $_POST['capt'];
                    $photo->alt_text = $_POST['alt'];
                    $photo->description = $_POST['descr'];
                    $photo->set_file($_FILES['img']);
                    $photo->save();
                    redirect("photos.php");
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
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Photo: <em><?= $photo->caption ?></em></h1>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?= $photo->title ?>">
                                </div>

                                <div class="form-group">
                                    <a href="" class="thumbnail"><img src="<?= $photo->image_path() ?>" alt="<?= $photo->alt_text ?>"></a>
                                </div>

                                <div class="form-group">
                                    <label for="image">File</label>
                                    <input type="file" name="img" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input type="text" name="capt" class="form-control" value="<?= $photo->caption ?>">
                                </div>

                                <div class="form-group">
                                    <label for="alter">Alternate Text</label>
                                    <input type="text" name="alt" class="form-control" value="<?= $photo->alt_text ?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="descr" class="form-control"><?= $photo->description ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                    <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                    </div>
                                <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?= $photo->id ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?= $photo->fileName ?></span>
                                    </p>
                                    <p class="text">
                                    File Type: <span class="data"><?= $photo->type ?></span>
                                    </p>
                                    <p class="text">
                                    File Size: <span class="data"><?= substr($photo->size, 0, 3) . " KB" ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href="delete_photo.php?id=<?= $photo->id ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                </div>
                                </div>          
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        

  <?php include("includes/footer.php"); ?>