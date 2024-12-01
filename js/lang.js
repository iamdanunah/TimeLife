document.addEventListener("DOMContentLoaded", function () {
    const ENButton = document.getElementById("ENbutton");
    const UAButton = document.getElementById("UAbutton");
    const ENForm = document.getElementById("ENform");
    const UAForm = document.getElementById("UAform");

    // Показуємо EN форму
    ENButton.addEventListener("click", function () {
        ENForm.style.display = "block";
        UAForm.style.display = "none";
    });

    // Показуємо UA форму
    UAButton.addEventListener("click", function () {
        ENForm.style.display = "none";
        UAForm.style.display = "block";
    });

    // Початковий стан
    ENForm.style.display = "block"; // або "none", якщо потрібно стартувати з прихованих форм
    UAForm.style.display = "none";
});