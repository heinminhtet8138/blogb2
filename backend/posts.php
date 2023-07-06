<?php 
include "../dbconnect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    // var_dump($id);
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header("location:posts.php");
}else{


    include "layouts/nav_sidebar.php";
    

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
                                                        <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                        <button type="button" class="btn btn-danger delete"  data-id="<?= $post['id'] ?>">Delete</button>
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

                <!--Delete Modal -->
<div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting....</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Are you sure delete?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="post">

            <input type="hidden" name="id" id="del_id">
            <button type="submit" class="btn btn-danger">Delete</button>
            
        </form>
      </div>
    </div>
  </div>
</div>

<?php 

    include "layouts/footer.php";
                                        }
?>