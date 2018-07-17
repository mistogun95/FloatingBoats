function controllaCognome()
{
    var name = document.getElementById('surname');
    var xhttp = new XMLHttpRequest();
    var label = null;
    var url = "controllaCognome.php";
    var params = encodeURI("surname=" + name.value);
    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            if (xhttp.responseText === "")
            {
                label = document.getElementById("surnameInsert");
                label.style.color = "red";
                label.innerHTML = "Cognome non inserito";
            }
            else if (xhttp.responseText === "KO")
            {
                label = document.getElementById("surnameInsert");
                label.style.color = "red";
                label.innerHTML = "Attenzione hai inserito un carattere speciale o un numero nel cognome";
            }
            else if (xhttp.responseText === "OK")
            {
                label = document.getElementById("surnameInsert");
                label.style.color = "green";
                label.innerHTML = "Cognome inserito corretto";
            }
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}