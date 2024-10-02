// JavaScript Document

window.addEventListener("load", () => {
    var address = document.getElementsByName("ReturnAddress")[0];

    address.value = window.location.href;
});