const input = document.querySelector("#phonenumber");

window.intlTelInput(input, {
  initialCountry: "bd",
  utilsScript: "../assets/js/intlTelInput/utils.js",
});