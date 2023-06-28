<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include "layouts/navbar.php";
    include "dbconnect.php";

    $sql = "SELECT * FROM posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();

    // var_dump($posts);


?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Hein Blog!</h1>
                    <p class="lead mb-0">Sharing is caring. Knowledge is power, Action is super power.</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                
                    <div class="col-lg-8">
                        <!-- Featured blog post-->
                        <?php 
                            foreach($posts as $post){
                        ?>
                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?= $post['created_at'] ?></div>
                                <h2 class="card-title"><?php echo $post['title'] ?></h2>
                                <p class="card-text"><?= $post['description'] ?></p>
                                <a class="btn btn-primary" href="#!">Read more →</a>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                        
                    </div>
                
                
                
<?php 
    include "layouts/footer.php";
?>