<?php
// ถ้ามีการส่งข้อมูลฟอร์ม
if (isset($_POST["user"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    // ตรวจสอบข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM admin WHERE user = '$user' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user"] = $row["user"];
        $_SESSION["name"] = $row["name"];
        header("Location: students.php");
        exit();
    } else {
        $error_message = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }

    $conn->close();
}
?>
