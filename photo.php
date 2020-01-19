<?php 
require_once("admin/includes/init.php");

    if(empty($_GET['id'])){
        redirect("index.php");
    }

    $photo = Photo::find_by_id($_GET['id']);

    if(isset($_POST['post'])){

        $author = $_POST['author'];
        $body = $_POST['body'];
    
        $new_comment = Comment::create_comment($photo->id, $author, $body, date("Y-m-d H:i:s"));

        if($new_comment){
            redirect("photo.php?id={$photo->id}");
        }         
    } else {
        $author = null;
        $body = null;
    }

    $comments = Comment::find_comments($photo->id);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1><?= $photo->title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <?= $photo->author ?>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= substr($photo->created_at, 0, 16) ?> <!--  August 24, 2013 at 9:00 PM --> </p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive img-single-page" src="admin/<?= $photo->image_path() ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"> <?= $photo->caption ?>
                <p> <?= $photo->description ?> </p> </p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comment Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input class="form-control" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea class="form-control" rows="3" name="body" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" name="post" value="Post">
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php foreach($comments as $comment): ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $comment->author ?>
                            <small> <?= substr($comment->created_at, 0, 16) ?></small>
                        </h4>
                        <?= $comment->body ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2018</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>