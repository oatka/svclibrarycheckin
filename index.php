<?php include "header.php"; ?>

<!-- Form เช็ตเวลาเข้าเรียน-->
<div class="container mt-4">
    <form action="session.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">รหัสนักเรียน</label>
            <input type="text" class="form-control" id="name" name="barcode" placeholder="รหัสนักเรียน" required autofocus>
        </div>
    </form>
</div>

<?php
date_default_timezone_set('Asia/Bangkok');
// ตรวจสอบการส่งค่า barcode มา
if (isset($_SESSION["barcode"])) {
    $barcode = $_SESSION["barcode"]; 
    // Query เพื่อดึงข้อมูลนักเรียนจากฐานข้อมูล
    $sql = "SELECT * FROM students WHERE st_barcode = '$barcode'";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลนักเรียนหรือไม่
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        
        // แสดงข้อมูลนักเรียน
        echo "<div class='container mt-4 text-center'>";
        echo "<img src='" . $student["st_img"] . "' alt='Student Image' class='img-thumbnail' style='max-width: 150px;'><br>";
        echo "รหัสนักเรียน: " . $student["st_barcode"] . "<br>";
        echo "ชื่อ: " . $student["st_name"] . "<br>";

        // ตรวจสอบว่ามี session เวลาเช็คเข้าเรียนอยู่หรือไม่
        if (isset($_SESSION["barcode"])) {
            // แสดงปุ่ม Confirm เช็คเวลา
            echo '<form action=""method="POST">
                    <input type="hidden" name="student_id" value="' . $student["id"] . '">
                    <button type="submit" name="confirm" class="btn btn-primary">เช็คเวลาเข้า</button>
                  </form>';
        }
        echo "</div>";
    } else {
        echo "ไม่พบข้อมูลนักเรียน";
    }
}

// ตรวจสอบการกดปุ่ม Confirm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"])) {
        $student_id = $_POST["student_id"];
        // บันทึก session เวลาเช็คเข้าเรียน
        $_SESSION["time_check"] = time();
        // บันทึกข้อมูลเวลาเข้าเรียนลงในตาราง time_check
        $date = date("Y-m-d");
        $check_in = date("H:i:s", $_SESSION["time_check"]);
        $sql_insert = "INSERT INTO time_check (st_id, st_date, st_in) VALUES ('$student_id', '$date', '$check_in')";
        $conn->query($sql_insert);
        echo "<script>alert('เช็คเวลาเข้าเรียนสำเร็จ');</script>";
        session_destroy();
        echo "<script>window.location.href = 'index.php';</script>";
}
?>

<?php include "footer.php"; ?>
