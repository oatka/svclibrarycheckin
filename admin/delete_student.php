<?php

// ตรวจสอบว่ามีการส่งค่า ID ที่ต้องการลบหรือไม่
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // ดึงข้อมูลนักเรียนที่ต้องการลบ
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลนักเรียนหรือไม่
    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found";
        exit();
    }

    // ถ้ามีการกดปุ่ม "Delete Student"
    if (isset($_POST["st_del"])) {
        // ลบข้อมูลนักเรียน
        $sql_delete = "DELETE FROM students WHERE id = $id";

        if ($conn->query($sql_delete) === TRUE) {
            // ลบไฟล์รูปภาพที่เกี่ยวข้อง (ตัวอย่าง)
            if (file_exists($student['st_img'])) {
                unlink($student['st_img']);
            }

            echo "Student deleted successfully";
            header("Location: students.php");
        } else {
            echo "Error: " . $sql_delete . "<br>" . $conn->error;
        }

        exit();
    }
} else {
    echo "Invalid student ID";
    exit();
}
?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Delete Student</h2>

        <!-- แสดงข้อมูลนักเรียนที่ต้องการลบ -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $student['st_name']; ?></h5>
                <p class="card-text">Barcode: <?php echo $student['st_barcode']; ?></p>
                <p class="card-text">Image: <img src="../<?php echo $student['st_img']; ?>" alt="Student Image" class="img-thumbnail" style="max-width: 200px;"></p>
            </div>
        </div>

        <!-- ฟอร์มลบนักเรียน -->
        <form method="post" action="">
            <input name="st_del" type="hidden">
            <div class="mt-3">
                <p class="text-danger">Are you sure you want to delete this student?</p>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Delete Student</button>
                <a href="students.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
