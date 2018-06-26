function controllaPassword()
{
    var password = document.getElementById('password');
    var xhttp = new XMLHttpRequest();
    var label = null;
    var url = "controllaPassword.php";
    var params = encodeURI("password=" + password.value);
    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            if (xhttp.responseText === "")
            {
                label = document.getElementById("passwordInsert");
                label.style.color = "red";
                label.innerHTML = "Password non inserita";
            }
            else if (xhttp.responseText === "KO")
            {
                label = document.getElementById("passwordInsert");
                label.style.color = "red";
                label.innerHTML = "Password non corretta deve avere almeno 8 caratteri e contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale";
            }
            else if (xhttp.responseText === "OK")
            {
                label = document.getElementById("passwordInsert");
                label.style.color = "green";
                label.innerHTML = "Password inserita rispetta i parametri richiesti";
            }
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}