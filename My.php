<?php

//////////////////////// ОДНЕ БЕЗПЛАНТЕ ПЕРЕКЛЮЧЕННЯ \\\\\\\\\\\\\\\\\\
$stmt = $pdo->prepare("SELECT timer, UNIX_TIMESTAMP(last_updated) as last_updated, mode FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$current_time = time(); // Поточний час у секундах
$current_timer = (int)$user['timer']; // Поточний таймер у секундах

// Перевірка активності режиму
if ($user['mode'] == 1) { 
    $elapsed_time = $current_time - (int)$user['last_updated']; // Час, що минув
    $current_timer = max(0, $current_timer - $elapsed_time); // Залишок часу

    // Оновлюємо `timer`, якщо час змінився
    if ($current_timer !== (int)$user['timer']) {
        $stmt = $pdo->prepare("UPDATE users SET timer = ?, last_updated = FROM_UNIXTIME(?) WHERE id = ?");
        $stmt->execute([$current_timer, $current_time, $user_id]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_mode'])) {
    if ($user['mode'] == 1) { // Режим активний, зупиняємо таймер
        $elapsed_time = $current_time - (int)$user['last_updated']; // Час, що минув
        $remaining_time = max(0, $current_timer - $elapsed_time); // Залишок часу

        // Оновлюємо статус режиму на неактивний, залишаємо поточний час
        $stmt = $pdo->prepare("UPDATE users SET mode = ?, last_updated = NULL WHERE id = ?");
        $stmt->execute([0, $user_id]);
    } else { // Режим неактивний, включаємо таймер
        // Оновлюємо тільки last_updated, щоб він відображав поточний час
        $stmt = $pdo->prepare("UPDATE users SET mode = ?, last_updated = FROM_UNIXTIME(?) WHERE id = ?");
        $stmt->execute([1, $current_time, $user_id]);
    }

    // Перенаправлення для уникнення повторного надсилання форми
    header("Location: index.php");
    exit;
}
// Отримуємо поточний режим користувача із сесії
$current_mode = isset($_SESSION['user']['mode']) ? $_SESSION['user']['mode'] : 0;


echo '<form method="POST" action="index.php">';
echo '<input type="hidden" name="toggle_mode" value="1">';
echo '<button type="submit">';
echo 'Перемкнути режим';
echo '</button>';
echo '</form>';
///////////////////////////////////////////////////////////////////////


echo '<a href="" onclick="">';
echo '<div class="">';
echo 'Кнопка';
echo '</div>';
echo '</a>';
?>
<!----------------------------------------------------------------------->
<!-- Кнопка -->
<a href="#" onclick="openModal('modal1'); return false;">
    <div class="button0">
        Відкрити модальне вікно
    </div>
</a>

<!-- Модальне вікно -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modal1')">&times;</span>
        <h2>Модальне вікно</h2>
        <p>Це ваше модальне вікно. Ви можете додати сюди 
		будь-яку інформацію.</p>
    </div>
</div>
<!----------------------------------------------------------------------->