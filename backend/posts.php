<?php 
    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";

    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();

    // var_dump($posts);
?>
                <main>
                    <div class="container-fluid px-4">
                        <div class="mt-3">
                            <h1 class="mt-4 d-inline">Posts</h1>
                            <a class="btn btn-primary float-end" href="create_post.php">Create Post</a>
                        </div>
                        
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Posts List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            foreach ($posts as $post) {
                                        ?>

                                                <tr>
                                                    <td><?= $post['title'] ?></td>
                                                    <td><?= $post['c_name'] ?></td>
                                                    <td><?= $post['u_name'] ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">Edit</button>
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </td>

                                                </tr>

                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

<?php 

    include "layouts/footer.php";

?>