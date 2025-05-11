// Initialization for ES Users
import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";
initMDB({ Dropdown, Collapse });

// Validacija forme za registraciju

document.getElementById('registerForm').addEventListener('submit', function(e) {
    const username            = document.getElementById('username').value.trim();
    const email               = document.getElementById('email').value.trim();
    const password            = document.getElementById('password').value.trim();
    const password_confirm    = document.getElementById('password_confirm').value.trim();
    const error = document.getElementById('error');

    let errorMsg = '';

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