function verificar() {
    const email = document.getElementById('email').value;
    if (email === '<?php echo $_SESSION["email"]?>') {
        Swal.fire({
            title: "The Internet?",
            text: "That thing is still around?",
            icon: "question"
            });
    } else {
        Swal.fire({
            title: "The Internet?",
            text: "That thing is still around?",
            icon: "question"
            });
    }
}
