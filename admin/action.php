<?php
require_once 'template/header.php';

if ( isset($_REQUEST['submit']) ) {
     $new_date = htmlspecialchars(date("l, M Y - h:i:s A"));
     $sql = "INSERT INTO notes VALUES(
          NULL,
          :title,
          :text_note,
          '$new_date')";

     $params = [ ':title' => $_REQUEST['title'],
                 ':text_note' => $_REQUEST['text_note']
               ];

     $prepare = $conn->prepare($sql);

     if ( $prepare->execute($params) ) {
          header("Location: index.php?action=add_1");
     }
}

?>

<?php if ( isset($_GET['page']) ) : ?>

     <?php if ( $_GET['page'] == 'add' ) : ?>

          <form action="<?= $_SERVER['PHP_SELF']; ?>?page=add" method="post">

               <input type="text" name="title" class="form-control bg-dark text-light border-secondary" placeholder="Title">

               <textarea name="text_note" rows="13" cols="80" class="form-control bg-dark text-light mt-3 mb-3 border-secondary" placeholder="Text"></textarea>

               <button type="submit" name="submit" class="btn btn-primary btn-lg">Add note</button>
          </form>

     <?php elseif ( $_GET['page'] == 'delete' ) : ?>
          <?php
               $id = $_GET['id'];
               $sql = "DELETE FROM notes WHERE id=$id";
               if ( $conn->query($sql) ) {
                    header("Location: index.php?action=delete_1");
               }else{
                    header("Location: index.php?action=delete_2");
               }
          ?>
     <?php endif; ?>

<?php endif; ?>

<?php require_once 'template/footer.php'; ?>
