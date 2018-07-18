"use strict";
function controlla(input)
{
    var xhttp = new XMLHttpRequest();
    var url = "";
    var message = "";
    var messageKo = "";
    var messageOK = "";
    var label = null; 

    switch (input.name)
    {
        case "name":
            url = "controllaNome.php";
            message = "Nome non inserito";
            messageKo = "Attenzione hai inserito un carattere speciale o un numero nel nome";
            messageOK = "Nome inserito corretto";
            label = document.getElementById("nameInsert"); 
            break;
        case "surname":
            url = "controllaCognome.php";
            message = "Cognome non inserito";
            messageKo = "Attenzione hai inserito un carattere speciale o un numero nel cognome";
            messageOK = "Cognome inserito corretto";
            label = document.getElementById("surnameInsert");
            break;
        case "username":
            url = "controllaUsername.php";
            message = "Username non inserito";
            messageKo = "Attenzione lo username non rispetta i parametri richiesti";
            messageOK = "Username inserito corretto";
            var messagePresent = "Username già utilizzato si prega di sceglierne un altro";
            label = document.getElementById("usernameInsert");
            break;
        case "password":
            url = "controllaPassword.php";
            message = "Password non inserita";
            messageKo = "Password non corretta deve avere almeno 8 caratteri e contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale";
            messageOK = "Password inserita rispetta i parametri richiesti";
            label = document.getElementById("passwordInsert");
            break;
    }

    var params = encodeURI(input.name + "=" + input.value);
    xhttp.open("POST", url, true);
    console.log(input.name + "="+  input.value);

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
}