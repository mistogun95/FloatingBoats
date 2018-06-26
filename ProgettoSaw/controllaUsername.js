function controllaUsername()
{
    var name = document.getElementById('username');
    var xhttp = new XMLHttpRequest();
    var label = null;
    var url = "controllaUsername.php";
    var params = encodeURI("username=" + name.value);
    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            if (xhttp.responseText === "")
            {
                label = document.getElementById("usernameInsert");
                label.style.color = "red";
                label.innerHTML = "Username non inserito";
            }
            else if (xhttp.responseText === "KO")
            {
                label = document.getElementById("usernameInsert");
                label.style.color = "red";
                label.innerHTML = "Attenzione lo username non rispetta i parametri richiesti";
            }
            else if (xhttp.responseText === "OK")
            {
                label = document.getElementById("usernameInsert");
                label.style.color = "green";
                label.innerHTML = "Username inserito corretto";
            }
            else if (xhttp.responseText === "UserPresente")
            {
                label = document.getElementById("usernameInsert");
                label.style.color = "red";
                label.innerHTML = "Username già utilizzato si prega di sceglierne un altro";
            }
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}