<?php include "header.php"; ?>
<?php
date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า timezone ให้ตรงกับเวลาท้องถิ่น
// ดึงข้อมูล time_check จากฐานข้อมูล
$sql = "SELECT students.*, time_check.st_date, time_check.st_in, time_check.st_out
FROM students
JOIN time_check ON students.id = time_check.st_id ORDER BY students.id DESC;";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูล time_check หรือไม่
if ($result->num_rows > 0) {
    $timeChecks = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $timeChecks = [];
}

// คำนวณจำนวนผู้เข้าใช้งานในวันที่ปัจจุบัน
$currentDate = date("Y-m-d");
$currentDateUsers = array_filter($timeChecks, function($timeCheck) use ($currentDate) {
    return $timeCheck['st_date'] == $currentDate;
});
$currentDateCount = count($currentDateUsers);
$currentDateUserNames = array_map(function($user) {
    return $user['st_name'];
}, $currentDateUsers);

$conn->close();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">เช็คเวลาเข้าใช้งาน</h2>

    <!-- แสดงรายการ time_check -->
    <?php if (!empty($timeChecks)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>วันที่</th>
                    <th>เข้าใช้ตอน</th>
                    <th>ออกตอน</th>
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
        <p class="text-center">ไม่มีผู้เข้าใช้งาน</p>
    <?php endif; ?>
</div>

<!-- Chat Widget -->
<div class="chat-widget">
    <div class="chat-header">
        <h5>ถามคำถาม</h5>
        <button id="chatToggle" class="chat-toggle">-</button>
    </div>
    <div class="chat-body" id="chatBody">
        <div class="chat-messages" id="chatMessages"></div>
        <form id="chatForm">
            <input type="text" id="chatInput" placeholder="พิมพ์ข้อความที่นี่..." required>
            <button type="submit">ส่ง</button>
        </form>
        <div class="chat-buttons">
            <button class="chat-question" data-question="สรุปผลรายวัน">สรุปผลรายวัน</button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const chatToggle = document.getElementById('chatToggle');
    const chatBody = document.getElementById('chatBody');
    const chatForm = document.getElementById('chatForm');
    const chatInput = document.getElementById('chatInput');
    const chatMessages = document.getElementById('chatMessages');
    const chatButtons = document.querySelectorAll('.chat-question');

    chatToggle.addEventListener('click', function() {
        if (chatBody.style.display === 'none' || chatBody.style.display === '') {
            chatBody.style.display = 'block';
            chatToggle.textContent = '-';
        } else {
            chatBody.style.display = 'none';
            chatToggle.textContent = '+';
        }
    });

    chatForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const message = chatInput.value.trim();
        if (message) {
            addMessage('user', message);
            chatInput.value = '';
            // Simulate a response from the system
            setTimeout(function() {
                processUserMessage(message);
            }, 1000);
        }
    });

    chatButtons.forEach(button => {
        button.addEventListener('click', function() {
            const question = button.getAttribute('data-question');
            addMessage('user', question);
            setTimeout(function() {
                processUserMessage(question);
            }, 1000);
        });
    });

    function addMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.className = sender === 'user' ? 'user-message' : 'system-message';
        messageElement.textContent = message;
        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function processUserMessage(message) {
        console.log("Processing message:", message); // Debugging log
        if (message === "สรุปผลรายวัน") {
            var currentDateCount = <?php echo json_encode($currentDateCount); ?>;
            var currentDate = "<?php echo $currentDate; ?>";
            var currentDateUserNames = <?php echo json_encode($currentDateUserNames); ?>;
            
            console.log("currentDateUserNames:", currentDateUserNames); // Debugging log

            // ตรวจสอบว่า currentDateUserNames เป็นอาร์เรย์หรือไม่
            if (Array.isArray(currentDateUserNames) && currentDateUserNames.length > 0) {
                var userNamesString = currentDateUserNames.join(", ");
                var resultText = "วันที่ " + currentDate + " มีผู้เข้าใช้งาน " + currentDateCount + " คน: " + userNamesString;
                console.log("Result text:", resultText); // Debugging log
                addMessage('system', resultText);
            } else {
                addMessage('system', 'ไม่มีข้อมูลผู้เข้าใช้งานในวันนี้');
            }
        } else {
            addMessage('system', 'นี่คือคำตอบของคุณ: ' + message);
        }
    }
});
</script>

<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
}

/* Chat Widget Styles */
.chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 300px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    z-index: 1000;
}

.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
}

.chat-toggle {
    background: none;
    border: none;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
}

.chat-body {
    display: none;
    padding: 10px;
}

.chat-messages {
    height: 200px;
    overflow-y: auto;
    border-bottom: 1px solid #ddd;
    margin-bottom: 10px;
}

.chat-messages div {
    padding: 5px;
    margin-bottom: 5px;
}

.chat-messages .user-message {
    text-align: right;
}

.chat-form {
    display: flex;
}

#chatInput {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px 0 0 5px;
}

#chatForm button {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

.chat-buttons {
    display: flex;
    justify-content: space-around;
    margin-top: 10px;
}

.chat-buttons button {
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<?php include "footer.php"; ?>
