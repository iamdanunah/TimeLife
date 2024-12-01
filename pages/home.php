<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ .'/../sys/db_connect.php';
include_once __DIR__ .'/../sys/user_data.php';

/* 

// Перевірка підключення до бази даних
$dbPath = __DIR__ . '/../sys/db_connect.php';

if (file_exists($dbPath)) {
    require_once $dbPath; // Підключення до бази даних
} else {
    die("Database connection file not found.");
}
// Перевірка, чи є користувач у сесії
if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'];
} else {
    echo "User is not logged in.";
} */






echo '<div class="balance_tl">';
echo '<div style="font-size: 15vw;">'.$user['balance'].'</div>';
//echo '&nbsp;';
//echo '<t style="font-size: 5vw;">TL</t>';
echo '</div>';


// Монетка
echo '<div class="coin-container">';
echo '<div class="coin">';

echo '<div class="coin-face coin-front">';
echo '</div>';

echo '<div class="coin-face coin-back">';
echo ''.htmlspecialchars($user['id']).'';
echo '</div>';

echo '</div>';
echo '</div>';

/* echo '<div class="">';
echo '<a href=""></a>';
echo '</div>'; */

$stmt = $pdo->prepare("SELECT last_tap, timer, balance, mode, UNIX_TIMESTAMP(last_updated) as last_updated FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$current_time = time();
$last_tap_timestamp = strtotime($user['last_tap']); 
$elapsed_time_since_tap = $current_time - $last_tap_timestamp; // Час з останнього натискання
// Тут я додав "-3600 сек", так не можна, але виходу немає...
$remaining_time_for_button = max(0, 86400 - $elapsed_time_since_tap - 3600); // Час до активації кнопки

// Перевіряємо режим
if ($user['mode'] == 1) {
    $elapsed_time_since_update = $current_time - (int)$user['last_updated'];
    $current_timer = max(0, (int)$user['timer'] - $elapsed_time_since_update);
} else {
    $current_timer = (int)$user['timer']; // У неактивному режимі таймер не змінюється
}

// Формуємо текст і статус кнопки
if ($remaining_time_for_button <= 0) {
    $button_class = 'button_24_on';
    $button_text = 'Pick up tokens';
    $data_time_left = 0;
} else {
    $hours = floor($remaining_time_for_button / 3600);
    $minutes = floor(($remaining_time_for_button % 3600) / 60);
    $seconds = $remaining_time_for_button % 60;

    // Форматуємо час, додаючи нулі до одиничних цифр
    $formatted_time = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);

    $button_class = 'button_24_off';
    $button_text = "Time left: $formatted_time";
    $data_time_left = $remaining_time_for_button;
}

// Вивід кнопки
echo '<form method="POST">';
echo '<button type="submit" name="pick_tokens" class="' . $button_class . '" ' . ($remaining_time_for_button > 0 ? 'disabled' : '') . ' data-time-left="' . $data_time_left . '">';
echo $button_text;
echo '</button>';
echo '</form>';

// Якщо кнопка натиснута
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pick_tokens']) && $remaining_time_for_button <= 0) {
    // Додаємо час і баланс, тільки якщо активний режим
    if ($user['mode'] == 1) {
        $stmt = $pdo->prepare("UPDATE users SET last_tap = NOW(), timer = timer + 86700, balance = balance + 0.001440 WHERE id = ?");
        $stmt->execute([$user_id]);
    } else {
        // Якщо неактивний режим, оновлюємо тільки баланс і час натискання
        $stmt = $pdo->prepare("UPDATE users SET last_tap = NOW(), balance = balance + 0.001440 WHERE id = ?");
        $stmt->execute([$user_id]);
    }

    header("Location: index.php");
    exit;
}
?>
<script>
    // Функція для оновлення таймера
    function updateTimer() {
        // Знаходимо всі кнопки з класом 'button_24_off'
        let timeLeftElements = document.querySelectorAll('.button_24_off');

        timeLeftElements.forEach(function(timeLeftElement) {
            // Отримуємо залишковий час з data-time-left
            let timeLeft = parseInt(timeLeftElement.getAttribute('data-time-left'));

            if (timeLeft > 0) {
                // Віднімаємо 1 секунду
                timeLeft--;

                // Оновлюємо текст на кнопці
                let hours = Math.floor(timeLeft / 3600);
                let minutes = Math.floor((timeLeft % 3600) / 60);
                let seconds = timeLeft % 60;

                // Форматуємо час з додаванням нулів
                let formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                timeLeftElement.innerHTML = `Time left: ${formattedTime}`;

                // Зберігаємо залишок часу в атрибуті
                timeLeftElement.setAttribute('data-time-left', timeLeft);
            }
        });
    }

    // Оновлюємо таймер кожну секунду
    setInterval(updateTimer, 1000);
</script>
