<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("เชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ตั้งค่าชุดอักขระเพื่อให้แสดงผลได้ถูกต้อง
$conn->set_charset("utf8");

// ตอนท้ายของไฟล์, คุณสามารถปิดการเชื่อมต่อเมื่อไม่ได้ใช้งานแล้ว
// mysqli_close($conn);

?>
