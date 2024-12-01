<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ .'/../sys/db_connect.php';
include_once __DIR__ .'/../sys/user_data.php';

echo '<table class="profile">';
echo '<tr>';

echo '<td class="profile_usernsme">';
echo 'NameUser'.htmlspecialchars($user['username']).'';
echo '</td>';
echo '<td class="profile_notification">';
echo '</td>';

echo '</tr>';
echo '</table>';

echo '<table class="profile_user-info">';
echo '<tr>';

echo '<td class="profile_email">';
echo 'eMail:<br>'.htmlspecialchars($user['email']).'';
echo '</td>';
echo '<td class="profile_d-reg">';
echo 'Account created at:<br>'.htmlspecialchars($user['created_at']).'<br>';
echo '</td>';

echo '</tr>';
echo '<tr>';

echo '<td class="profile_balance">';
echo 'Balance:<br>'.htmlspecialchars($user['balance']).'';
echo '</td>';
echo '<td class="profile_id">';
echo 'ID:<br>'.htmlspecialchars($user['id']).'';
echo '</td>';

echo '</tr>';
echo '</table>';

echo '<br><a href="sys/logout.php" class="nav-button" data-page="home">вийти</a>';

echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';
echo '';







?>