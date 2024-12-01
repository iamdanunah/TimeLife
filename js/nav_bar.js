document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.nav-button');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const contentContainer = document.getElementById('content');

    // Функція для завантаження вмісту сторінки
    function loadPage(page) {
        contentContainer.innerHTML = 'Loading...';

        fetch('pages/' + page + '.php')
            .then(response => response.text())
            .then(data => {
                contentContainer.innerHTML = data;

                // Ініціалізація монетки після завантаження нової сторінки
                initCoinFlip();
            })
            .catch(error => {
                contentContainer.innerHTML = 'ERROR load page';
            });
    }

    // Обробка кліків на кнопки навігації
    const navButtons = document.querySelectorAll('.nav-button');
    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            const page = button.getAttribute('data-page');
            loadPage(page);
        });
    });

    // Завантажуємо сторінку за замовчуванням (home)
    loadPage('home');
});