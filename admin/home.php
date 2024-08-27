<?php include "header.php"; ?>
<?php
/*
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่ (ตัวอย่าง)
if (!isset($_SESSION["admin_user"])) {
    header("Location: index.php");
    exit();
}
// ตรวจสอบว่ามีการส่งคำสั่ง (เพิ่ม/แก้ไข/ลบ)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // โค้ดเพิ่มนักเรียน
    } elseif (isset($_POST["edit"])) {
        // โค้ดแก้ไขนักเรียน
    } elseif (isset($_POST["delete"])) {
        // โค้ดลบนักเรียน
    }
}
*/
// ดึงข้อมูลนักเรียนจากฐานข้อมูล
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลนักเรียนหรือไม่
if ($result->num_rows > 0) {
    $students = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $students = [];
}

$conn->close();
?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Students</h2>

        <!-- แสดงรายการนักเรียน -->
        <?php if (!empty($students)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Barcode</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['st_name']; ?></td>
                            <td><?php echo $student['st_barcode']; ?></td>
                            <td><?php echo $student['st_img']; ?></td>
                            <td>
                                <a href="students.php?action=edit&id=<?php echo $student['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="students.php?action=delete&id=<?php echo $student['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-center">No students found.</p>
        <?php endif; ?>

        <!-- ลิงก์ไปยังฟอร์มเพิ่ม/แก้ไข/ลบ -->
        <div class="text-center mt-4">
            <a href="students.php?action=add" class="btn btn-primary">Add Student</a>
        </div>
    </div>
    <?php include "footer.php"; ?>
