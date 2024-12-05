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