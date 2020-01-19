<?php include("includes/header.php"); ?>

        <?php
            if(!$session->signedIn()){
                redirect('login.php');
            }
        ?>

        <?php   
            $err_message = "";
            if(isset($_POST['submit'])){

                $photo = new Photo();
                $photo->title = trim($_POST['title']);
                $photo->caption = trim($_POST['capt']);
                $photo->description = trim($_POST['description']);
                $photo->author = trim($_POST['author']);
                $photo->created_at = date('Y-m-d H:m');
                $photo->alt_text = trim($_POST['alt']);
                $photo->set_file($_FILES['fileUpload']);

                if($photo->save()){
                    $err_message = "<span class='text-success'>Photo upload successfully</span>";
                } else {
                    $err_message = join("<span class='text-danger'></span>", $photo->custom_errors);
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
                    <div class="col-md-12">
                        <h1 class="page-header">Upload
                            <small>Subheading</small>
                        </h1>

                        <div class="col-md-6">
                            <span class="text-danger"><?php echo $err_message; ?></span>
                            <form action="upload.php" enctype="multipart/form-data" method="post">
                            
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input type="text" name="capt" class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Author</label>
                                    <input type="text" name="author" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="alt">Alternative Text</label>
                                    <input type="text" name="alt" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="fileUpload">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        

  <?php include("includes/footer.php"); ?>