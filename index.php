<?php include("includes/header.php"); ?>

<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$total_count = 4;

$paginate = new Paginate($page, $items_per_page, $total_count);

$offset = $paginate->offset();

$sql = "SELECT * FROM photo LIMIT $items_per_page OFFSET $offset";

$photos = Photo::find_query($sql);

?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="row">
                    <?php foreach($photos as $photo): ?>
                        <div class="col-md-3 col-xs-6">
                            <div class="single-post">
                                <img src="admin/<?= $photo->image_path() ?>" alt="">
                                <p><?= $photo->title ?></p>
                                <a href="photo.php?id=<?= $photo->id ?>" class="single_post">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>    

            <!-- Blog Sidebar Widgets Column -->    
            <div class="col-md-4">
                 <?php include("includes/sidebar.php"); ?>
            </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <ul class="pager">

                    <?php 
                        if($paginate->page_total() > 1){

                            if($paginate->has_next()){
                                echo '<li class="next"><a href="?page= '.$paginate->next().'"><i class="fa fa-arrow-right"></i></a></li>';
                            }

                        }              
                    ?>
                    
                    <li class="prev"><a href="?page=<?= $paginate->previous()?>"><i class="fa fa-arrow-left"></i></a></li>
                </ul>
            </div>
        </div>
        
<?php include("includes/footer.php"); ?>


