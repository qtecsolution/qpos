const paymentMethods = document.querySelectorAll(".payment-method");

paymentMethods.forEach((method) => {
    method.addEventListener("click", () => {
        // Deselect all payment methods
        paymentMethods.forEach((method) => {
            method.classList.remove("selected");
            method.querySelector('input[type="radio"]').checked = false;
        });

        // Select the clicked payment method
        method.classList.add("selected");
        method.querySelector('input[type="radio"]').checked = true;
    });
});
