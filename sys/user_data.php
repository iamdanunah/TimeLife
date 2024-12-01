<?php
$user_id = $_SESSION['user_id'];
// Запит на отримання даних користувача з БД
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
