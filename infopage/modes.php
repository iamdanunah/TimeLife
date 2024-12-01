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

echo '<div class="modal-content_UAEN">';

echo '<a id="ENbutton">';
echo '<div class="modal-content_UAEN-BTN">';
echo 'EN';
echo '</div>';
echo '</a>';

echo '<a id="UAbutton">';
echo '<div class="modal-content_UAEN-BTN">';
echo 'UA';
echo '</div>';
echo '</a>';

echo '</div>';//echo '<div class="fc_ra-buttons_reg_auth">';

$style = '
	margin-top: 5vw;
    font-size: 7vw;
	color: rgba(0, 255, 200, 1.0);
	text-shadow: 0 0 10px rgba(0, 255, 200, 1.0);
';
$current_balance = (float)$user['balance']; // Баланс користувача

echo '<div class="modal_form-container">';

echo '<div class="modal_form" id="ENform">';
echo 'Your game mode: 
<span style="color:red;font-weight: bold;font-size: 6vw;text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);">';
echo ''.$user['mode'] == 1 ? 'TimeLife' : 'TimeLine';
echo '</span></br></br>';
echo 'Do you want to change the game mode?</br></br>';
echo 'To change the game mode, simply proceed with the operation.
		A fee of 1 TL will be deducted</br></br>';
		
echo '<a href="#" onclick="submitToggleForm()">';
echo '<div style="'.$style.'">';
echo 'Switch mode (-1 TL)';
echo '</div>';
echo '</a>';

echo '</div>';//echo '<div class="form" id="ENform">';

echo '<div class="modal_form" id="UAform">';
echo 'Твій режим гри: 
<span style="color:red;font-weight: bold;font-size: 6vw;text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);">';
echo ''.$user['mode'] == 1 ? 'TimeLife' : 'TimeLine';
echo '</span></br></br>';
echo 'Хочеш змінити режим гри?</br></br>';
echo 'Щоб змінити режим гри, просто продовжи операцію. За це
		буде знято 1TL</br></br>';
		
echo '<a href="#" onclick="submitToggleForm()">';
echo '<div style="'.$style.'">';
echo 'Перемкнути режим (-1 TL)';
echo '</div>';
echo '</a>';
echo '</div>';//echo '<div class="form" id="UAform">';

echo '</div>';//echo '<div class="form-container">';
?>
<!-- Все нижче для переключення режиму -->
<form id="toggleForm" method="POST" action="index.php">
    <input type="hidden" name="toggle_mode" value="1">
</form>

<script>
    function submitToggleForm() {
        document.getElementById('toggleForm').submit();
    }
</script>
