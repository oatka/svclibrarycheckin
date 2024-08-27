<?php
// ตรวจสอบว่ามีการส่งค่า ID ที่ต้องการแก้ไขหรือไม่
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // ดึงข้อมูลนักเรียนที่ต้องการแก้ไข
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลนักเรียนหรือไม่
    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found";
        exit();
    }

    // ถ้ามีการส่งข้อมูลฟอร์ม
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $st_name = $_POST["st_name"];
        $st_barcode = $_POST["st_barcode"];

        // ตรวจสอบการอัปโหลดไฟล์รูปภาพ
        if (!empty($_FILES["st_img"]["name"])) {
            $file_name = $_FILES["st_img"]["name"];
            $file_tmp = $_FILES["st_img"]["tmp_name"];
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
            $st_img = "uploads/" . $file_name;

            // ลบไฟล์รูปภาพเดิม (ตัวอย่าง)
            if (file_exists($student['st_img'])) {
                unlink($student['st_img']);
            }
        } else {
            // ถ้าไม่มีการอัปโหลดไฟล์รูปภาพใหม่, ใช้รูปภาพเดิม
            $st_img = $student['st_img'];
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $sql_update = "UPDATE students SET st_name = '$st_name', st_barcode = '$st_barcode', st_img = '$st_img' WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            echo "Student updated successfully";
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
    }
} else {
    echo "Invalid student ID";
    exit();
}

?>


    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Student</h2>

        <!-- ฟอร์มแก้ไขนักเรียน -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="st_name" class="form-label">Name:</label>
                <input type="text" name="st_name" class="form-control" value="<?php echo $student['st_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="st_barcode" class="form-label">Barcode:</label>
                <input type="text" name="st_barcode" class="form-control" value="<?php echo $student['st_barcode']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="st_img" class="form-label">Image:</label>
                <input type="file" name="st_img" class="form-control" accept="image/*">
                <img src="../<?php echo $student['st_img']; ?>" alt="Student Image" class="img-thumbnail mt-2" style="max-width: 200px;">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
    </div>
