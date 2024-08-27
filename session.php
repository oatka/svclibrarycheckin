<?php
session_start();
if(isset($_POST["barcode"])){
    $_SESSION["barcode"] = $_POST["barcode"];

    
    header("Location: index.php");
}
?>