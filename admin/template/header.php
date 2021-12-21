<?php
session_start();

if ( !isset($_SESSION['login']) ) {
     header("Location: ../index.php");
}

require_once '../core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <title>Notas</title>
</head>
<body class="bg-dark text-light">
     <div class="container">
          <div class="text-center mb-4 mt-5 fs-1 fw-bold">
               <a href="index.php" class="text-decoration-none text-light">Notas</a>
          </div>
          <div class="row mb-5">
               <div class="col-sm-2">
                    <ul style="list-style: none;" class="p-0">
                         <li class="mt-3">
                              <a href="action.php?page=add" class="btn btn-success">Add Note</a>
                         </li>
                         <li class="mt-3">
                              <a href="pin.php" class="btn btn-primary">Pin</a>
                         </li>
                         <li class="mt-3">
                              <a href="log-off.php" class="btn btn-danger">Log off</a>
                         </li>
                    </ul>
               </div>
               <div class="col-sm-10">
