<?php
session_start();
session_unset(); // Видаляємо всі змінні сесії
session_destroy(); // Знищуємо сесію

// Перенаправляємо на сторінку авторизації
header('Location: ../login.php');
exit();
?>
