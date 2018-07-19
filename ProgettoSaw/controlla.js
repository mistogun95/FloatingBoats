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
            message = "Nome non inserito";
            messageKo = "Attenzione hai inserito un carattere speciale o un numero nel nome";
            messageOK = "Nome inserito corretto";
            label = document.getElementById("nameInsert");
            if (input.value === "")
            {
                label.style.color = "red";
                label.innerHTML = message;
            }
            else if (regexNumber.test(input.value) || regexSpecial.test(input.value))
            {
                label.style.color = "red";
                label.innerHTML = messageKo;
            }
            else
            {
                label.style.color = "green";
                label.innerHTML = messageOK;
            }
            break;
        case "surname":
            message = "Cognome non inserito";
            messageKo = "Attenzione hai inserito un carattere speciale o un numero nel cognome";
            messageOK = "Cognome inserito corretto";
            label = document.getElementById("surnameInsert");
            if (input.value === "")
            {
                label.style.color = "red";
                label.innerHTML = message;
            }
            else if (regexNumber.test(input.value) || regexSpecial.test(input.value))
            {
                label.style.color = "red";
                label.innerHTML = messageKo;
            }
            else
            {
                label.style.color = "green";
                label.innerHTML = messageOK;
            }
            break;
        case "username":
            var xhttp = new XMLHttpRequest();
            var url = "controllaUsername.php";
            message = "Username non inserito";
            messageKo = "Attenzione lo username non rispetta i parametri richiesti";
            messageOK = "Username inserito corretto";
            var messagePresent = "Username già utilizzato si prega di sceglierne un altro";
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
                        label.innerHTML = message;
                    }
                    else if (xhttp.responseText === "KO")
                    {
                        label.style.color = "red";
                        label.innerHTML = messageKo;
                    }
                    else if (xhttp.responseText === "OK")
                    {
                        label.style.color = "green";
                        label.innerHTML = messageOK;
                    }
                    else if (xhttp.responseText === "UserPresente")
                    {
                        label.style.color = "red";
                        label.innerHTML = messagePresent;
                    }
                }
            }
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(params);
            break;
        case "password":
            message = "Password non inserita";
            messageKo = "Password non corretta deve avere almeno 8 caratteri e contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale";
            messageOK = "Password inserita rispetta i parametri richiesti";
            label = document.getElementById("passwordInsert");
            if (input.value === "")
            {
                label.style.color = "red";
                label.innerHTML = message;
            }
            else if (!regexNumber.test(input.value) || !regexSpecial.test(input.value) || !regexUppercase.test(input.value) || !regexLowercase.test(input.value) || input.value.lenght < 8)
            {
                label.style.color = "red";
                label.innerHTML = messageKo;
            }
            else
            {
                label.style.color = "green";
                label.innerHTML = messageOK;
            }
            break;
    }
}