<!-- Тут можна підключити скрипти -->

<!-- Анімація заднього фону --><!--
<script src="js/particles.js" defer></script>
<canvas id="particleCanvas"></canvas>
-->

<!-- Переключення між сторінками без перезавантаження  -->
<script src="js/nav_bar.js"></script>
<!---->

<!-- Анімація монетки -->
<script src="js/coin_flip.js" defer></script>
<!---->

<!-- Таймер -->
<script src="js/timer_script.js"></script>
<!---->



<!---->
<script>
// Відкриття модального вікна
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "block";
    }
}

// Закриття модального вікна
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

// Закриття модального вікна при кліку поза його межами
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
};
</script>

<script>
let remainingTime = <?= $current_timer ?>; // Залишок часу з PHP
const isTimerActive = <?= $user['mode'] ?>; // Чи активний таймер?
const timerDisplay = document.getElementById('timer_display');

function formatTimer(seconds) {
    const years = Math.floor(seconds / (365 * 24 * 3600));
    seconds %= 365 * 24 * 3600;
    const weeks = Math.floor(seconds / (7 * 24 * 3600));
    seconds %= 7 * 24 * 3600;
    const daysOfWeek = Math.floor(seconds / (24 * 3600));
    seconds %= 24 * 3600;
    const hours = Math.floor(seconds / 3600);
    seconds %= 3600;
    const minutes = Math.floor(seconds / 60);
    seconds %= 60;
    return `${String(years).padStart(4, '0')}•${String(weeks).padStart(2, '0')}•${daysOfWeek}•${String(hours).padStart(2, '0')}•${String(minutes).padStart(2, '0')}•${String(seconds).padStart(2, '0')}`;
}

function updateTimer() {
    if (isTimerActive && remainingTime > 0) {
        remainingTime--; // Зменшуємо час на 1 секунду
        timerDisplay.textContent = formatTimer(remainingTime); // Оновлюємо відображення таймера
    }
}

// Оновлюємо відображення на початку
timerDisplay.textContent = formatTimer(remainingTime);

// Запускаємо оновлення таймера кожну секунду, якщо він активний
if (isTimerActive && remainingTime > 0) {
    setInterval(updateTimer, 1000);
}
</script>

<?php
?>

</table>
</body>
</html>
