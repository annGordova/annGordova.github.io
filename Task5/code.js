"use strict";
function calc() {
    let form = document.forms.calculator;
    let a = form.elements.price;
    let b = form.elements.count;
    let a0 = form.elements.price0;
    let b0 = form.elements.count0;
    let a1 = form.elements.price1;
    let b1 = form.elements.count1;
    let result = document.getElementById("result");
    let r = a.value * b.value + a0.value * b0.value + a1.value * b1.value;
    if(isNaN(r)) {
        result.innerHTML = names + ", пожалуйста, введите числовые значения";
    }
    else {
        result.innerHTML = names + ", Ваш заказ стоит: " + r + " угандийских шиллингов";
    }
}
window.addEventListener("DOMContentLoaded", function (event) {
  console.log("DOM fully loaded and parsed");
});
let names = prompt("Введите фамилию и имя заказчика", "Великий покупатель бегемотов");