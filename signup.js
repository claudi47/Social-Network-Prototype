const form = document.forms['signup'];
form.addEventListener('submit', validation);

function validation(event) {
    let verifica = 0;

   if (form.name.value.length == 0 || form.surname.value.length == 0 || form.email.value.length == 0 ||
        form.username.value.length == 0 || form.password.value.length == 0 || form.confirm_password.value.length == 0) {
		const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>Inserisci tutti i campi!</p>";
        verifica = 1;
    }

    if (form.password.value !== form.confirm_password.value) {
        const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>Le password non corrispondono!</p>";
        verifica = 1;
    }

    if (form.username.value.indexOf(' ') !== -1) {
        const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>L'username contiene spazi!</p>";
        verifica = 1;
    }

    if(verifica == 1) {
        event.preventDefault();
    }
} 

const user = form.username;
user.addEventListener('blur', check_username);
let flag;

function check_username(event) {
    console.log(user.value)
    fetch('http://151.97.9.184/sicari_claudio/Homework1/HMW1/search_username.php?username=' + user.value).then(onResponse).then(onText); 
}

function onResponse(response) {
    return response.text();
}

function onText(text) {
    if (text == 1) {
        const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>Username già scelto!</p>";
        verifica = 1;
    }    
}