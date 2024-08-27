<?php
if (isset($_POST["st_name"])) {
    $st_name = $_POST["st_name"];
    $st_barcode = $_POST["st_barcode"];

    // ตรวจสอบการอัปโหลดไฟล์รูปภาพ
    if (isset($_FILES["st_img"])) {
        $file_name = $_FILES["st_img"]["name"];
        $file_tmp = $_FILES["st_img"]["tmp_name"];
        move_uploaded_file($file_tmp, "../uploads/" . $file_name);
        $st_img = "uploads/" . $file_name;
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO students (st_name, st_barcode, st_img) VALUES ('$st_name', '$st_barcode', '$st_img')";
    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Student</h2>

        <!-- ฟอร์มเพิ่มนักเรียน -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="st_name" class="form-label">Name:</label>
                <input type="text" name="st_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="st_barcode" class="form-label">Barcode:</label>
                <input type="text" name="st_barcode" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="st_img" class="form-label">Image:</label>
                <input type="file" name="st_img" class="form-control" accept="image/*" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Add Student</button>
            </div>
        </form>
    </div>

