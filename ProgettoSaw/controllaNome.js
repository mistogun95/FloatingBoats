function controllaNome()
{
    var name = document.getElementById('name');
    var xhttp = new XMLHttpRequest();
    var label = null;
    var url = "controllaNome.php";
    var params = encodeURI("name=" + name.value);
    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            if (xhttp.responseText === "")
            {
                label = document.getElementById("nameInsert");
                label.style.color = "red";
                label.innerHTML = "Nome non inserito";
            }
            else if (xhttp.responseText === "KO")
            {
                label = document.getElementById("nameInsert");
                label.style.color = "red";
                label.innerHTML = "Attenzione hai inserito un carattere speciale o un numero nel nome";
            }
            else if (xhttp.responseText === "OK")
            {
                label = document.getElementById("nameInsert");
                label.style.color = "green";
                label.innerHTML = "Nome inserito corretto";
            }
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}