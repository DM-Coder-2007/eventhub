const nameRegex = /^[a-zA-Z\s]{2,50}$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

function validate(event) {
    const full_name = document.getElementById("full_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (full_name === "" || !nameRegex.test(full_name)) {
        alert("Enter a valid name!");
        event.preventDefault(); // Stop submission so they can fix it
        document.getElementById("full_name").value = "";
        document.getElementById("full_name").focus();
        return;
    }

    if (email === "" || !emailRegex.test(email)) {
        alert("Enter a valid email!");
        event.preventDefault(); 
        document.getElementById("email").value = "";
        document.getElementById("email").focus();
        return;
    }

    if (password === "" || !passwordRegex.test(password)) {
        alert("Password must be at least 8 characters and include a number, an uppercase, and a lowercase letter.");
        event.preventDefault(); 
        document.getElementById("password").value = "";
        document.getElementById("password").focus();
        return;
    }
}