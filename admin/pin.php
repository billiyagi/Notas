<?php
require_once 'template/header.php';

// Update
if ( isset($_REQUEST['submit']) ) {

     $old_pin = $_REQUEST['old_pin'];
     $new_pin = $_REQUEST['new_pin'];
     $new_confirm_pin = $_REQUEST['new_confirm_pin'];

     if ( strlen($new_pin) == 6 && strlen($new_confirm_pin) == 6 ) {
          if ($new_pin == $new_confirm_pin) {
               $new_pin = $new_confirm_pin;
          } else {
               header("Location: pin.php?edit=not_match");
          }
     }else{
          header("Location: pin.php?edit=length");
     }

     $result_pin = password_hash( $new_pin, PASSWORD_DEFAULT);

     // Verification pin
     $result = $conn->query("SELECT * FROM users WHERE id='1'");
     $row = $result->fetch(PDO::FETCH_OBJ);

     if ( password_verify($old_pin, $row->pin) ) {
          $sql = "UPDATE users SET pin=:pin WHERE id='1'";
          $query = $conn->prepare($sql);

          $params = [':pin' => $result_pin];
          if ( $query->execute($params) ) {
               header("Location: pin.php?edit=success");
          }else{
               header("Location: pin.php?edit=failed");
          }
     } else {
          header("Location: pin.php?edit=old_pin");
     }

}



if ( isset($_GET['edit']) ) {
     if ( $_GET['edit'] == 'old_pin' ) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>Wrong Old Pin!</strong> Please check your Pin again.
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
     } elseif ( $_GET['edit'] == 'failed' ) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>New Pin Failed!</strong> Fill your pin again.
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
     } elseif ( $_GET['edit'] == 'length' ) {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <strong>Pin must be 6 digits!</strong> Fill your New pin again.
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
     } elseif ( $_GET['edit'] == 'not_match' ) {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <strong>Pin not match</strong> please check your new pin and confirm new pin fields.
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
     } elseif ( $_GET['edit'] == 'success' ) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>Howdey!</strong> Update Pin successfull.
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
     }
}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

     <label for="" class="form-label">Old Pin</label>
     <input type="password" name="old_pin" class="form-control text-light bg-dark border-secondary" placeholder="Enter you pin">

     <div class="row">
          <div class="col-lg-6">
               <label for="" class="form-label mt-4">New Pin</label>
               <input type="password" name="new_pin" class="form-control text-light bg-dark border-secondary" placeholder="Enter you pin">
          </div>
          <div class="col-lg-6">
               <label for="" class="form-label mt-4">Confirm New Pin</label>
               <input type="password" name="new_confirm_pin" class="form-control text-light bg-dark border-secondary" placeholder="Enter you pin">
          </div>
     </div>
     <button type="submit" name="submit" class="btn btn-lg btn-primary mt-4">Update Pin</button>
</form>

<?php require_once 'template/footer.php'; ?>
