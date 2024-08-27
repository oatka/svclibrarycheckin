<?php include "header.php"; ?>
<?php
/*
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่ (ตัวอย่าง)
if (!isset($_SESSION["admin_user"])) {
    header("Location: index.php");
    exit();
}
*/
if (isset($_GET["action"])) {
    $action = $_GET["action"];

    switch ($action) {
        case "add":
            include('add_student.php');
            break;
        case "edit":
            include('edit_student.php');
            break;
        case "delete":
            include('delete_student.php');
            break;
        default:
            // หากไม่ตรงกับทุกรายการ, นำกลับไปที่หน้าจัดการนักเรียน
            header("Location: students.php");
            exit();
    }
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
        <h2 class="text-center mb-4">หน้าต่างการจัดการนักเรียน</h2>

        <!-- แสดงรายการนักเรียน -->
        <?php if (!empty($students)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ชื่อ</th>
                        <th>รหัสนักเรียน</th>
                        <th>รูปนักเรียน</th>
                        <th>เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['st_name']; ?></td>
                            <td><?php echo $student['st_barcode']; ?></td>
                            <td><img src="../<?php echo $student['st_img']; ?>" width="50"/></td>
                            <td>
                                <a href="students.php?action=edit&id=<?php echo $student['id']; ?>" class="btn btn-warning">แก้ไข</a>
                                <a href="students.php?action=delete&id=<?php echo $student['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">ลบ</a>
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
            <a href="students.php?action=add" class="btn btn-primary">เพิ่มนักเรียน</a>
        </div>
    </div>
    <?php include "footer.php"; ?>
