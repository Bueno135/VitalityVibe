document.getElementById('form-cadastro').addEventListener('submit', function(event) {
    event.preventDefault();
    var email = document.getElementById('emailLogin').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'email.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('resultado').textContent = xhr.responseText;
        }
    };
    xhr.send('email=' + email);
});
