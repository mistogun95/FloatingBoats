function check_new_message()
{
    var Id_chat = document.getElementById('');
    var xhttp = new XMLHttpRequest();
    var label = null;
    var url = "controllaPassword.php";
    var params = encodeURI("password=" + password.value);
    xhttp.open("POST", url, true);
}