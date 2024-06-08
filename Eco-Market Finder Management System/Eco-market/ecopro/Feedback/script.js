function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;

    if (username.trim() == "") {
        alert("Please enter your username.");
        return false;
    }

    if (email.trim() == "") {
        alert("Please enter your email.");
        return false;
    } else if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // You can add additional validation for other fields here

    return true;
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}