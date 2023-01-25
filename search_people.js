const form = document.forms['form_search_people'];
form.addEventListener("submit", validation);

function validation(event) {
    if (form.username.value.length == 0) {
        const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>Non hai inserito nessun nome!</p>";
        event.preventDefault();
        return;
    }

    do_search_people(event);
}

function do_search_people(event) {
    event.preventDefault();
    const user = form.username;
    principale_div.innerHTML='';
    fetch('http://151.97.9.184/sicari_claudio/Homework1/HMW1/do_search_people.php?username=' + user.value).then(onResponse).then(onJson);
}

function onResponse(response) {
    return response.json();
}

const principale_div = document.getElementById("container");

function onJson(json) {
    console.log(json)
    if (json[0] == 0) {
        const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>Nessun utente trovato!</p>";
        return;
    }

    if(json[0] == 2) {
        const div_hidden = document.getElementById("error");
        div_hidden.innerHTML = "<p>Non puoi cercare te stesso</p>";
        return;
    }

    principale_div.innerHTML='';

    for (element of json) {
        const div = document.createElement("div");
        const img = document.createElement("img");
        const span = document.createElement("span");
        const button = document.createElement("button");
        button.id = element.username;

        div.classList.add("box_risultato");
        
        img.src = element.immagine;
        span.textContent = element.username;
        
        button.value=element.username;

        principale_div.appendChild(div);
        div.appendChild(span);
        div.appendChild(img);
        div.appendChild(button);

        if(element.followed == 1) {
            button.textContent="Unfollow";
            button.addEventListener('click', unfollow);
        }
        else {
            button.textContent="Follow";
            button.addEventListener('click', follow);
        }
    }
}

function follow(event) {
    console.log("Sono nella follow")

    const bottone= event.currentTarget;
    console.log(event.currentTarget)
    const url= "http://151.97.9.184/sicari_claudio/Homework1/HMW1/follow_people.php?username=" + bottone.value;
    console.log(url)

    fetch(url).then(onResponse).then(onFollow);
}

function onFollow(json) {
    let button = document.getElementById(json[0]);
    button.textContent = "Unfollow";
    button.removeEventListener('click', follow);
    button.addEventListener('click', unfollow);

}

function unfollow(event) {
    const bottone= event.currentTarget;
    fetch("http://151.97.9.184/sicari_claudio/Homework1/HMW1/unfollow_people.php?username=" + bottone.value).then(onResponse).then(onUnfollow);
}

let varr2;

function onUnfollow(json) {
    let button = document.getElementById(json[0]);
    button.textContent = "Follow";
    button.removeEventListener('click', unfollow);
    button.addEventListener('click', follow);        
}

const butt_all = document.getElementById('tutto');
butt_all.addEventListener("click", showall);

function showall(event) {
    principale_div.innerHTML='';
    fetch("http://151.97.9.184/sicari_claudio/Homework1/HMW1/show_all.php").then(onResponse).then(onJson);
}