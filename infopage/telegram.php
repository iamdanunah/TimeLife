<?php
// Перевірка чи сесія вже запущена
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../sys/db_connect.php';
include_once '../sys/user_data.php';

// Перевірка авторизації
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


// Отримання ID користувача
$userId = $_SESSION['user_id'];

// Обробка запиту
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'telegram') {
    // Перевіряємо значення tg
    $query = "SELECT tg FROM users WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['tg'] == 0) {
        // Оновлюємо значення tg, timer та balance
        $query = "UPDATE users SET tg = 1, timer = timer + 600, balance = balance + 0.1 WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId]);
    }

    // Перенаправлення на Telegram
    header("Location: https://t.me/yourtelegramgroup");
    exit();
}
?>

<div class="modal-content_NAME">
    Telegram
</div>

<div class="modal_form">
    This is our Telegram channel, where you can find the latest news about the TimeLife project.</br></br>

    <form method="POST" action="">
        <input type="hidden" name="action" value="telegram">
        <button type="submit" class="modal_form_tab">Telegram</button>
    </form>
</div>
