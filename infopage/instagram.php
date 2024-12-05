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

echo '<div class="modal-content_NAME">';
echo 'Instagram Live';
echo '</div>';

echo '<div class="modal_form">';

echo 'The Instagram page of our project, or more precisely, 
our development team. Photos from daily life, videos of interesting 
moments, and everything related to the TimeLife team.</br></br>';

echo '<a href="">';
echo '<div class="modal_form_tab">';
echo 'Instagram';
echo '</div>';
echo '</a>';

echo '</div>';//echo '<div class="modal_form">';
?>
