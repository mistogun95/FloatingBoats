"use strict";
function controlla(input)
{
    var message = "";
    var messageKo = "";
    var messageOK = "";
    var label = null;
    var regexUppercase = new RegExp('[A-Z]');
    var regexLowercase = new RegExp('[a-z]');
    var regexNumber = new RegExp('[0-9]');
    var regexSpecial = new RegExp(/[^\w\s]/gi); 

    switch (input.name)
    {
        case "name":
            label = document.getElementById("nameInsert");
            if (input.value === "")
            {
                label.style.color = "red";
                label.innerHTML = "Nome non inserito";
            }
            else if (regexNumber.test(input.value) || regexSpecial.test(input.value))
            {
                label.style.color = "red";
                label.innerHTML = "Attenzione hai inserito un carattere speciale o un numero nel nome";
            }
            else
            {
                label.style.color = "green";
                label.innerHTML = "Nome inserito corretto";
            }
            break;
        case "surname":
            label = document.getElementById("surnameInsert");
            if (input.value === "")
            {
                label.style.color = "red";
                label.innerHTML = "Cognome non inserito";
            }
            else if (regexNumber.test(input.value) || regexSpecial.test(input.value))
            {
                label.style.color = "red";
                label.innerHTML = "Attenzione hai inserito un carattere speciale o un numero nel cognome";
            }
            else
            {
                label.style.color = "green";
                label.innerHTML = "Cognome inserito corretto";
            }
            break;
        case "username":
            var xhttp = new XMLHttpRequest();
            var url = "controllaUsername.php";
            label = document.getElementById("usernameInsert");
            var params = encodeURI(input.name + "=" + input.value);
            xhttp.open("POST", url, true);

            xhttp.onreadystatechange = function()
            {
                if (xhttp.readyState == 4 && xhttp.status == 200)
                {
                    if (xhttp.responseText === "")
                    {
                        label.style.color = "red";
                        label.innerHTML = "Username non inserito";
                    }
                    else if (xhttp.responseText === "KO")
                    {
                        label.style.color = "red";
                        label.innerHTML = "Attenzione lo username non rispetta i parametri richiesti";
                    }
                    else if (xhttp.responseText === "OK")
                    {
                        label.style.color = "green";
                        label.innerHTML = "Username inserito corretto";
                    }
                    else if (xhttp.responseText === "UserPresente")
                    {
                        label.style.color = "red";
                        label.innerHTML = "Username già utilizzato si prega di sceglierne un altro";
                    }
                }
            }
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(params);
            break;
        case "password":
            label = document.getElementById("passwordInsert");
            if (input.value === "")
            {
                label.style.color = "red";
                label.innerHTML = "Password non inserita";
            }
            else if (!regexNumber.test(input.value) || !regexSpecial.test(input.value) || !regexUppercase.test(input.value) || !regexLowercase.test(input.value) || input.value.lenght < 8)
            {
                label.style.color = "red";
                label.innerHTML = "Password non corretta deve avere almeno 8 caratteri e contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale";
            }
            else
            {
                label.style.color = "green";
                label.innerHTML = "Password inserita rispetta i parametri richiesti";
            }
            break;
    }
}