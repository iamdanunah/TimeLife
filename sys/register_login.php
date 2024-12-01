<?php
// Перевірка чи сесія вже запущена
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//////////////////////////////////////////////////////////\
$blockedIds = file('sys/blocked_ids.txt', FILE_IGNORE_NEW_LINES);
$message = '';

function generateUniqueId($blockedIds) {
	
// Під час підбору ID не враховується цифра 0, для того
// що б не плутати її із літерою O... Тому її видалено
// з підбору

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $idLength = 10;
    do {
        $uniqueId = '';
        for ($i = 0; $i < $idLength; $i++) {
            $uniqueId .= $characters[rand(0, strlen($characters) - 1)];
        }
    } while (in_array($uniqueId, $blockedIds));
    return $uniqueId;
}

// Обробка реєстрації
if (isset($_POST['register'])) {
    $email = $_POST['register_email'];
    $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);
    $uniqueId = generateUniqueId($blockedIds);
    $timer = '1000';
	//$balance = '666';

    // Перевірка, чи існує вже такий користувач
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $message = "";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (id, email, password, timer) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$uniqueId, $email, $password, $timer, $balance])) {
            $message = "Registration OK. Your ID: $uniqueId";
        } else {
            $message = "Registration ERROR";
        }
    }
}

// Обробка авторизації
if (isset($_POST['login'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    // Перевірка користувача в БД
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Зберігаємо ID користувача в сесію
        $_SESSION['user_id'] = $user['id'];

        // Переадресація на головну сторінку
        header('Location: index.php');
        exit(); // Зупиняємо виконання скрипта
    } else {
        $message = "eMail failed";
    }
}


?>
