<?php 
ob_start(); 
include("includes/header.php"); 
?>

<?php 

    if(empty($_GET['search'])){
        redirect("index.php");
    }

    if(isset($_GET['submit'])){

        $query = $_GET['search'];
        
        $photo = new Photo();

        $search_res = $photo->search($query);

    }
?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="row">
                    <?php if(!empty($search_res)) : ?>
                        
                        <h2>Result of search: <?= $_GET['search'] ?></h2>

                
                        <?php foreach($search_res as $obj): ?>
                            <div class="col-md-3 col-xs-6">
                                <div class="single-post">
                                    <img src="admin/<?= $obj->image_path() ?>" alt="">
                                    <p><?= $obj->title ?></p>
                                    <a href="photo.php?id=<?= $obj->id ?>" class="single_post">Read More <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    

                        <?php else: ?>

                            <h2>Nothing found on your request: <?= $_GET['search'] ?></h2>


                    <?php endif; ?>

                </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->    
            <div class="col-md-4">
                 <?php include("includes/sidebar.php"); ?>
            </div>
        <!-- /.row -->
        
<?php include("includes/footer.php"); ?>