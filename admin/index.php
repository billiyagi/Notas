<?php
require_once 'template/header.php';
$result = $conn->query("SELECT * FROM notes");

if ( isset($_GET['action']) ) {

     if ( $_GET['action'] == 'delete_1' ) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Delete Succesfull</strong> You should check in on some of those fields below.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

     } elseif( $_GET['action'] == 'delete_0' ) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Delete Failed</strong> Please check your query and database.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

     } elseif( $_GET['action'] == 'add_1' ) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Add Succesfull</strong> Check in on some of those fields below.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

     } elseif( $_GET['action'] == 'add_0' ) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Add Failed</strong> Please check your query and database.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
     }
}
?>

     <?php if ( $result->rowCount() == 0 ) : ?>
          <img src="../img/undraw_empty_xct9.svg" alt="Empty" class="w-100" style="height: 300px;">
     <?php else: ?>
     <div class="row">
          <?php while ( $row = $result->fetch(PDO::FETCH_OBJ) ) : ?>
          <div class="col-sm-4">
               <div class="card bg-dark p-3 border-secondary">
                    <h5>
                         <a href="note.php?id=<?= $row->id; ?>" class="text-light"><?= excerpt($row->title, 20); ?></a>
                    </h5>
                    <hr>
                    <p>
                         <?= excerpt($row->text_note, 30); ?>
                    </p>
                    <small class="text-secondary">Last Edited: <br> <?= $row->time_note; ?></small>
               </div>
          </div>
          <?php endwhile; ?>
     <?php endif; ?>
</div>
<?php include 'template/footer.php'; ?>
