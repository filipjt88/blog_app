// Initialization for ES Users
import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";
initMDB({ Dropdown, Collapse });

// Validacija forme za registraciju
document.getElementById('registerForm').addEventListener('submit', function(e) {
    // Selektovanje elemenata i prikupljanje vrednosti
    const username  = document.getElementById('username').value.trim();
    const email     = document.getElementById('email').value.trim();
    const password  = document.getElementById('password').value.trim();
    const password_confirm = document.getElementById('password_confirm').value.trim();
    const error = document.getElementById('error');

    let errorMsg = '';
// Validacija i provera unosa da li su polja za unos prazna
    if(!username || !email || !password || !password_confirm) {
        errorMsg = 'Sva polja su obavezna!';
    } else if(password.length < 6) {
        errorMsg = 'Lozinka mora imati minimum 6 karaktera!';
    } else if(password !== password_confirm) {
        errorMsg = 'Lozinke se ne poklapaju!';
    }

    if(errorMsg) {
        e.preventDefault();
        error.textContent = errorMsg;
    }
});


// Login
document.getElementById("loginForm").addEventListener("submit", function(e) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    let error = '';

    if(!email || !password) {
        error = 'Popunite sva polja';
    }

    if(error) {
        e.preventDefault();
        document.getElementById('loginError').textContent = error;
    }
});