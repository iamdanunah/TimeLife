<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ .'/../sys/db_connect.php';
include_once __DIR__ .'/../sys/user_data.php';

////////////////////////////////////////////////////////////////////////
// Завдання для користувачів
echo '<div class="earns">';
// Завдання стосовно комюніті TimeLife
echo '<div class="earn_tasks">';
echo 'Main tasks';
echo '</div>';

// Телеграм ////////////////////////////////////////////////////////////
// кнопка яка викликає завдання
?>
<a href="#" onclick="openModal('modalTELEGRAM'); return false;">
<?php
echo '<div class="earn_list">';
echo 'Telegram';
echo '</div>';
?>
</a>
<?php
// вікно із завданням
echo '<div id="modalTELEGRAM" class="modal"><div class="modal-content">';
?>
<span class="modal-content_close" onclick="closeModal('modalTELEGRAM')">&times;</span>
<?php
include_once '../infopage/telegram.php';
echo '</div></div>';
////////////////////////////////////////////////////////////////////////
// все остальне дублює попередній код, де змінюється тільки назва //////
// і ІНКЛУД сторінки ///////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

// Instagram
?>
<a href="#" onclick="openModal('modalInstagram'); return false;">
<?php
echo '<div class="earn_list">';
echo 'Instagram';
echo '</div>';
?>
</a>
<?php
echo '<div id="modalInstagram" class="modal"><div class="modal-content">';
?>
<span class="modal-content_close" onclick="closeModal('modalInstagram')">&times;</span>
<?php
include_once '../infopage/instagram.php';
echo '</div></div>';


// Tik-Tok
?>
<a href="#" onclick="openModal('modalTik-Tok'); return false;">
<?php
echo '<div class="earn_list">';
echo 'Tik-Tok';
echo '</div>';
?>
</a>
<?php
echo '<div id="modalTik-Tok" class="modal"><div class="modal-content">';
?>
<span class="modal-content_close" onclick="closeModal('modalTik-Tok')">&times;</span>
<?php
include_once '../infopage/tiktok.php';
echo '</div></div>';



// YouTube
?>
<a href="#" onclick="openModal('modalYouTube'); return false;">
<?php
echo '<div class="earn_list">';
echo 'YouTube';
echo '</div>';
?>
</a>
<?php
echo '<div id="modalYouTube" class="modal"><div class="modal-content_tascks">';
?>
<span class="modal-content_close" onclick="closeModal('modalYouTube')">&times;</span>
<?php
include_once '../infopage/youtube.php';
echo '</div></div>';


// X Twitter
?>
<a href="#" onclick="openModal('modalXTwitter'); return false;">
<?php
echo '<div class="earn_list">';
echo 'X Twitter';
echo '</div>';
?>
</a>
<?php
echo '<div id="modalXTwitter" class="modal"><div class="modal-content">';
?>
<span class="modal-content_close" onclick="closeModal('modalXTwitter')">&times;</span>
<?php
include_once '../infopage/xtwitter.php';
echo '</div></div>';



echo '<div class="earn_tasks_2">';
echo 'Other tasks';
echo '</div>';

echo '<a href="" >';
echo '<div class="earn_list_2">';
echo 'Task 1';
echo '</div>';
echo '</a>';

echo '<a href="" >';
echo '<div class="earn_list_2">';
echo 'Task 2';
echo '</div>';
echo '</a>';

echo '<a href="" >';
echo '<div class="earn_list_2">';
echo 'Task 3';
echo '</div>';
echo '</a>';



echo '</div>';
?>