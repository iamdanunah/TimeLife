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

$current_balance = (float)$user['balance']; // Баланс користувача

echo '<div class="modal-content_NAME">';
echo 'Switch mode';
echo '</div>';

echo '<div class="modal_form">';
echo 'Your game mode: ';

echo '<span class="modal_form_close">';
echo ''.$user['mode'] == 1 ? 'TimeLife' : 'TimeLine';
echo '</span></br></br>';

echo 'Do you want to change the game mode?</br></br>';
echo 'To change the game mode, simply proceed with the operation.
		A fee of 1 TL will be deducted</br></br>';


if ($current_balance >= 1) 
{
echo '<a href="#" onclick="submitToggleForm()">';
echo '<div class="modal_form_tab">';
echo 'Switch mode (-1 TL)';
echo '</div>';
echo '</a>';
}else{
echo '<a href="#" onclick="submitToggleForm()">';
echo '<div class="modal_form_tab">';
echo 'Switch mode (-1 TL)';
echo '</div>';
echo '</a>';
echo '<span class="modal_form_notTL">';
echo ''.$notTL.'';
echo '</span>';
}

echo '</div>';//echo '<div class="modal_form">';

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

