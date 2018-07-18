"use strict";
function cancellaCampi()
{
    var name = document.getElementById("name");
    var surname = document.getElementById("surname");
    var username = document.getElementById("username");
    var password = document.getElementById("password");

    name.value = "";
    surname.value = "";
    username.value = "";
    password.value = "";
}