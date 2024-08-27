<?php include "header.php"; ?>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">เข้าสู่ระบบผู้ดูแล</h2>

                        <?php
                        // ตรวจสอบข้อผิดพลาดจากการล็อกอิน (ถ้ามี)
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger'>$error_message</div>";
                        }
                        ?>

                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="admin_user" class="form-label">ชื่อ:</label>
                                <input type="text" name="user" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="admin_pass" class="form-label">รหัส:</label>
                                <input type="password" name="pass" class="form-control" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>