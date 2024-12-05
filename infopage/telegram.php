<?php
// Перевірка чи сесія вже запущена
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../sys/db_connect.php';
include_once '../sys/user_data.php';
/* // Вивести значення ID користувача з сесії
echo "Session User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "Not set");
echo "Session Cookie: " . session_id();  // Виводимо ідентифікатор сесії
error_log("User ID: " . $_SESSION['user_id']);
 */

// Перевірка авторизації
if (!isset($_SESSION['user_id']))
{
// Якщо користувач не авторизований 
// перенаправляємо на сторінку авторизації
header('Location: login.php');
exit();
}
// Обробка запиту
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; // Упевніться, що сесія ініціалізована і ID встановлено.

    // Отримання даних користувача
    $stmt = $conn->prepare("SELECT tg FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['tg'] == 0) {
            // Оновлення значень
            $stmt = $conn->prepare("UPDATE users SET tg = 1, timer = timer + 600, balance = balance + 0.1 WHERE id = ?");
            $stmt->bind_param("i", $userId);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Нарахування виконано.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Помилка оновлення.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Ви вже отримали бонус.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Користувача не знайдено.']);
    }
    exit;
}



echo '<div class="modal-content_NAME">';
echo 'Telegram';
echo '</div>';

echo '<div class="modal_form">';

echo 'This is our Telegram channel, where you can find 
		the latest news about the TimeLife project.</br></br>';
?>

    <a href="#" onclick="sendRequest(); return false;">
        <div class="modal_form_tab">Telegram</div>
    </a>
<?php
echo '';

echo '</div>';//echo '<div class="modal_form">';
?>
    <script>
        // Функція для обробки натискання на кнопку
        function sendRequest() {
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    window.location.href = "https://t.me/yourtelegramgroup";
                }
            })
            .catch(error => console.error('Помилка:', error));
        }
    </script>
