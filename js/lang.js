document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".modal-content_UAEN").forEach((modalContainer) => {
        const ENButton = modalContainer.querySelector(".ENbutton");
        const UAButton = modalContainer.querySelector(".UAbutton");
        const ENForm = modalContainer.querySelector(".ENform");
        const UAForm = modalContainer.querySelector(".UAform");

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
        ENForm.style.display = "block";
        UAForm.style.display = "none";
    });
});