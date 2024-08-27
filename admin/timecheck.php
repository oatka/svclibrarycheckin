<?php include "header.php"; ?>
<?php
// Establish database connection
// (Make sure $conn is defined and connected to your database)

$dateFilter = isset($_POST['date_filter']) ? $_POST['date_filter'] : '';

// Fetch time check records based on selected date or show all records if no date is selected
if ($dateFilter) {
    $sql = "SELECT students.*, time_check.st_date, time_check.st_in, time_check.st_out
            FROM students
            JOIN time_check ON students.id = time_check.st_id
            WHERE DATE(time_check.st_date) = '$dateFilter'
            ORDER BY students.id DESC;";
} else {
    $sql = "SELECT students.*, time_check.st_date, time_check.st_in, time_check.st_out
            FROM students
            JOIN time_check ON students.id = time_check.st_id
            ORDER BY students.id DESC;";
}

$result = $conn->query($sql);

// Check if any records were found
if ($result->num_rows > 0) {
    $timeChecks = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $timeChecks = [];
}

$conn->close();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">ตารางเช็คเวลาการเข้าใช้งาน</h2>

    <!-- Date Filter Form -->
    <form method="POST" class="mb-4 text-center">
        <label for="date_filter">เลือกวันที่:</label>
        <input type="date" id="date_filter" name="date_filter" value="<?php echo $dateFilter; ?>">
        <button type="submit" class="btn btn-primary">ค้นหา</button>
        <button type="reset" name="reset_filter" class="btn btn-secondary">รีเซ็ต</button>
    </form>

    <!-- Display time check records -->
    <?php if (!empty($timeChecks)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>วันที่</th>
                    <th>เวลาเข้าใช้งาน</th>
                    <th>เวลาออก</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($timeChecks as $timeCheck) : ?>
                    <tr>
                        <td><?php echo $timeCheck['st_name']; ?></td>
                        <td><?php echo $timeCheck['st_date']; ?></td>
                        <td><?php echo $timeCheck['st_in']; ?></td>
                        <td><?php echo $timeCheck['st_out']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center">ไม่พบข้อมูลการเข้าใช้งาน</p>
    <?php endif; ?>
</div>
<?php include "footer.php"; ?>
