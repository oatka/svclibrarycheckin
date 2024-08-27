<?php session_start(); ?>
<?php //print_r($_SESSION); ?>
<?php error_reporting(E_ALL);
ini_set('display_errors', 1); ?>
<?php include "../db.php"; ?>
<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;700&display=swap">
  <title></title>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">ระบบเช็คนักเรียน</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
         
          <li class="nav-item">
            <a class="nav-link" href="students.php">นักเรียน</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="timecheck.php">เวลาเข้าใช้งาน</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="creator.php">ผู้จัดทำ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>