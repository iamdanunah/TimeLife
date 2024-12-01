// Функція ініціалізації монетки
function initCoinFlip() {
    const coin = document.querySelector('.coin');

    if (!coin) return; // Якщо монетки немає, виходимо з функції

    let isFlipped = false;
    coin.addEventListener('click', () => {
        isFlipped = !isFlipped;
        coin.classList.toggle('flip', isFlipped);
    });
}

// Ініціалізуємо монетку після завантаження сторінки через AJAX
document.addEventListener('DOMContentLoaded', () => {
    initCoinFlip();
});