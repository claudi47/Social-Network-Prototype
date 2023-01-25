const form = document.forms["login"];
form.addEventListener("submit", validation);

function validation(event) {

    if (form.username.value.length == 0 || form.password.value.length == 0) {
        event.preventDefault();
        const div_hidden = document.querySelector('.hidden');
        const par = div_hidden.querySelector("p");
        par.textContent = 'Inserire tutte le credenziali';
    }
}