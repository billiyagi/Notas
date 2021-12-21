<?php
require_once 'template/header.php';

// if ( !isset($_GET['id']) ) {
//      header("Location: index.php");
// }

// Fetch ALL
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM notes WHERE id=$id");
$row = $result->fetch(PDO::FETCH_OBJ);


// Update
if ( isset($_REQUEST['submit']) ) {
     $id = $_REQUEST['id'];
     $new_date = htmlspecialchars(date("l, M Y - h:i:s A"));
     $sql = "UPDATE notes SET
               title = :title,
               text_note = :text_note,
               time_note = '$new_date' WHERE id=$id";

     $params = [ ':title' => $_REQUEST['title'],
                 ':text_note' => $_REQUEST['text_note']
               ];

     $prepare = $conn->prepare($sql);

     if ($prepare->execute($params)) {
          header("Location: note.php?id=" . $id);
     }
}
?>
<div class="mb-3">
     <a href="index.php" class="text-decoration-none me-3">Back to home</a>
     <a href="action.php?page=delete&id=<?= $row->id; ?>" onclick="return confirm('Are you sure want to delete?')" class="text-decoration-none text-danger">Delete note</a>
</div>
<form action="<?= $_SERVER['PHP_SELF']; ?>?id=<?= $row->id; ?>" method="post">
     <input type="hidden" name="id" value="<?= $row->id; ?>">
     <input type="text" name="title" value="<?= $row->title; ?>" class="form-control bg-dark text-light border-secondary" placeholder="Title">

     <textarea name="text_note" rows="13" cols="80" class="form-control bg-dark text-light mt-3 mb-3 border-secondary" placeholder="Text"><?= $row->text_note; ?></textarea>

     <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
</form>

<?php require_once 'template/footer.php'; ?>
