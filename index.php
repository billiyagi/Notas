<?php
session_start();
if ( isset($_SESSION['login']) ) {
     header("Location: admin/index.php");
}

if ( isset($_REQUEST['submit']) ) {
     require_once 'core/class/DB.php';
     $result = $conn->query("SELECT pin FROM users WHERE id='1'");
     $row = $result->fetch(PDO::FETCH_OBJ);

     if ( !empty($_REQUEST['pin']) ) {
          if ( password_verify($_REQUEST['pin'], $row->pin) ) {
               // Set Session
               session_start();
               $_SESSION['login'] = true;
               header("Location: admin/index.php");
          }else{
               header("Location: index.php?pin=wrong");
          }
     }else{
          header("Location: index.php?pin=empty");
     }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <title>Notas</title>
</head>
<body class="bg-dark text-light">

<main class="container m-auto vh-100 d-flex justify-content-center align-items-center">
     <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="text-center mb-4">
               <h1 class="fw-bold">Notas</h1>
               <p>Enter your Pin to login</p>
          </div>
          <input type="password" name="pin" placeholder="Enter your pin" class="text-center form-control fw-bold fs-3" autofocus tabindex="1">
          <button type="submit" name="submit" class="d-none"></button>


          <?php if ( isset($_GET['pin']) ) : ?>

               <?php if ( $_GET['pin'] == 'wrong' ) : ?>
                    <p class="text-danger text-center mt-2">Wrong Pin!</p>

               <?php elseif ( $_GET['pin'] == 'empty' ) :  ?>
                    <p class="text-warning text-center mt-2">Please enter your pin!</p>

               <?php endif; ?>

          <?php endif; ?>
     </form>
</main>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.4.1.slim.min.js"></script>
</body>
</html>
