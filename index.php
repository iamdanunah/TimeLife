<?php

// Перевірка чи сесія вже запущена
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'sys/db_connect.php';
include_once 'sys/user_data.php';
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
$title = 'TimeLife';
include_once 'head.php';

// Отримуємо ID користувача із сесії (передбачаємо, що користувач авторизований)
$user_id = $_SESSION['user_id']; // отримання id користувача
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
//////////// код нижче не дай бог зачепити, бо я  //////////////////////
//////////// з цією хуйньою їбався 3 дня з лишком //////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
// ТАЙМЕР, ВІДЛІК І ЗБЕРЕЖЕННЯ
// Отримуємо дані користувача
$stmt = $pdo->prepare("SELECT timer, UNIX_TIMESTAMP(last_updated) as last_updated, mode, balance FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$current_time = time(); // Поточний час у секундах
$current_timer = (int)$user['timer']; // Поточний таймер у секундах
$current_balance = (float)$user['balance']; // Баланс користувача

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
    if ($current_balance >= 1) { // Перевірка наявності балансу
        // Віднімаємо 1 TL
        $new_balance = $current_balance - 1;
        $stmt = $pdo->prepare("UPDATE users SET balance = ? WHERE id = ?");
        $stmt->execute([$new_balance, $user_id]);

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
    } else {
        // Вивід повідомлення про недостатній баланс
        echo "<p>Недостатньо TL для перемикання режиму.</p>";
    }
}
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

if ($user['mode'] == 1)
{
	$top_bar_style = 'top_bar_timer_on';
}else{
	$top_bar_style = 'top_bar_timer_off';	
}
?>
<a href="#" onclick="openModal('modal1'); return false;">
<?php
// Верхня панель (Фіксована, вгорі)
echo '<div class="top_bar '.$top_bar_style.'">';
echo '<span id="timer_display">0000•00•0•00•00•00</span>';
echo '</div>';
?>
</a>

<!-- Модальне вікно -->
<div id="modal1" class="modal"><div class="modal-content">
<span class="modal-content_close" onclick="closeModal('modal1')">&times;</span>
<?php
include_once 'infopage/modes.php';
?>
</div></div>
<?php
// Вміст сторінки (все, що між панелями)
echo '<div class="main_content" id="content">';
// Завантажуємо відповідну сторінку залежно від параметра у URL
if (isset($_GET['page'])) 
{
	$page = $_GET['page'];
}else{
	$page = 'home';  // Сторінка за замовчуванням
}

// Перевірка, щоб завантажити правильну сторінку
$file = "pages/{$page}.php";

if (file_exists($file)) 
{
	include($file);
}else{
	echo 'Not Page';
}

echo '</div>';



// Нижня панель (Фіксована, внизу)
echo '<div class="bottom_bar_navigation">';
echo '<a href="#" class="nav-button" data-page="home">Home</a>';
echo '<a href="#" class="nav-button" data-page="earn">Earn</a>';
echo '<a href="#" class="nav-button" data-page="profile">Account</a>';
echo '</div>';

include_once 'foot.php';
?>
<script>
document.addEventListener("load", function() {
    const ENButton = document.getElementById("ENbutton");
    const UAButton = document.getElementById("UAbutton");
    const ENForm = document.getElementById("ENform");
    const UAForm = document.getElementById("UAform");

    ENButton.addEventListener("click", function () {
        ENForm.style.display = "block";
        UAForm.style.display = "none";
    });

    UAButton.addEventListener("click", function () {
        ENForm.style.display = "none";
        UAForm.style.display = "block";
    });

    ENForm.style.display = "block";
    UAForm.style.display = "none";
});
</script>
