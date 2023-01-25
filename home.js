mostrapost();

function mostrapost() {
    fetch('http://151.97.9.184/sicari_claudio/Homework1/HMW1/show_post.php').then(onResponse).then(onJson);
}

function onResponse(response) {
    return response.json();
}

const contenitore = document.getElementById("contenitore");

function onJson(json) {
    console.log(json)

    for (element of json) {
        if (element.followed == 1) {
            if (element.type == 'openlibrary') {

                const div_ol = document.createElement("div");
                div_ol.classList.add("div_open");
                const butt_like = document.createElement("button");
                butt_like.id = element.id;
                butt_like.value = element.id;
    
                const pic = document.createElement("img");
                const title = document.createElement("h3");
                const content = document.createElement("p");
                const creatore = document.createElement("h5")
                const title_book = document.createElement("h4");
                const author_book = document.createElement("h5");
                const num_like = document.createElement("p");
                const data_div = document.createElement("h6");
                console.log(element.data)
                const data_post = element.data_post;
    
                pic.src = element.immagine;
                title.textContent = element.titolo;
                content.textContent = element.contenuto;
                creatore.textContent = "creato da: " + element.creato_da;
                title_book.textContent = element.title;
                author_book.textContent = "di: " + element.author;
                num_like.textContent = "Piace a " + element.likes + " persone";
                num_like.id = 'likes';
                data_div.textContent = data_post;
    
                contenitore.appendChild(div_ol);
                div_ol.appendChild(pic);
                div_ol.appendChild(title);
                div_ol.appendChild(content);
                div_ol.appendChild(creatore);
                div_ol.appendChild(title_book);
                div_ol.appendChild(author_book);
                div_ol.appendChild(butt_like);
                div_ol.appendChild(num_like);
                div_ol.appendChild(data_div);
    
                if(element.liked == 1) {
                    butt_like.textContent = 'Non mi piace';
                    butt_like.addEventListener('click', IDontLikeIt);
                }
                if(element.liked == 0) {
                    butt_like.textContent = 'Mi piace';
                    butt_like.addEventListener('click', ILikeIt);
                }
                if (element.likes != 0) {
                    num_like.addEventListener("click", see_likes);
                }
            }

            else {
                const div_you = document.createElement("div");
                div_you.classList.add("div_tube");
                const butt_like = document.createElement("button");
                butt_like.id = element.id;
                butt_like.value = element.id;
    
                const iframe = document.createElement("iframe");
                const title = document.createElement("h3");
                const content = document.createElement("p")
                const creatore = document.createElement("h5")
                const title_video = document.createElement("h4");
                const author_video = document.createElement("h5");
                const num_like = document.createElement("p");
                const data_div = document.createElement("h6");
                console.log(element.data)
                const data_post = element.data_post;
    
                iframe.src = element.immagine;
                title.textContent = element.titolo;
                content.textContent = element.contenuto;
                creatore.textContent = "creato da: " + element.creato_da;
                title_video.textContent = element.title;
                author_video.textContent = "di: " + element.author;
                num_like.textContent = "Piace a " + element.likes + " persone";
                num_like.id = 'likes';
                data_div.textContent = data_post;
    
                contenitore.appendChild(div_you);
                div_you.appendChild(iframe);
                div_you.appendChild(title);
                div_you.appendChild(content);
                div_you.appendChild(creatore);
                div_you.appendChild(title_video);
                div_you.appendChild(author_video);
                div_you.appendChild(butt_like);
                div_you.appendChild(num_like);
                div_you.appendChild(data_div);
    
                if(element.liked == 1) {
                    butt_like.textContent = 'Non mi piace';
                    butt_like.addEventListener('click', IDontLikeIt);
                }
                if(element.liked == 0) {
                    butt_like.textContent = 'Mi piace';
                    butt_like.addEventListener('click', ILikeIt);
                }
                if (element.likes != '0') {
                    num_like.addEventListener("click", see_likes);
                }
            }
        }   
    }
}

function ILikeIt(event) {
    const button = event.currentTarget;
    console.log(button.value)
    const url = "http://151.97.9.184/sicari_claudio/Homework1/HMW1/LikePeople.php?id=" + button.value;
    fetch(url).then(onResponse).then(onLike);
}

function onLike(json) {
    console.log(json);
    console.log(json[0])
    const button = document.getElementById(json[0].id_post);
    button.textContent = "Non mi piace";
    button.removeEventListener("click", ILikeIt);
    button.addEventListener("click", IDontLikeIt);
    const padre = button.parentElement;
    const cont_like = padre.querySelector('p#likes');
    cont_like.textContent = "Piace a " + json[0].num_likes + " persone"
    cont_like.addEventListener('click', see_likes);
}

function IDontLikeIt(event) {
    const button = event.currentTarget;
    console.log(button.value)
    const url = "http://151.97.9.184/sicari_claudio/Homework1/HMW1/DontLikePeople.php?id=" + button.value;
    fetch(url).then(onResponse).then(onDislike);
}

function onDislike(json) {
    console.log(json)
    const button = document.getElementById(json[0].id_post);
    button.textContent = "Mi piace";
    button.removeEventListener("click", IDontLikeIt);
    button.addEventListener("click", ILikeIt);
    const padre = button.parentElement;
    const cont_like = padre.querySelector('p#likes');
    cont_like.textContent = "Piace a " + json[0].num_likes + " persone";
    if (json[0].num_likes == 0) {
        cont_like.removeEventListener('click', see_likes);
    }
    else {
        cont_like.addEventListener('click', see_likes);
    }
}

function see_likes(event) {
    const par_like = event.currentTarget;
    console.log(par_like)
    const father = par_like.parentElement;
    console.log(father)
    const button_post = father.querySelector("button");
    const id_post = button_post.value;
    fetch("http://151.97.9.184/sicari_claudio/Homework1/HMW1/see_likes.php?id=" + id_post).then(onResponse).then(onSeeLike);
}

function onSeeLike(json) {
    const all_buttons = document.querySelectorAll("button");
    for (let button of all_buttons) {
        if(button.value == 'Mi piace') {
            button.removeEventListener('click', IDontLikeIt);
        }
        else {
            button.removeEventListener('click', ILikeIt);
        }
    }
    const div_hidden = document.querySelector('.hidden');
    div_hidden.classList.remove("hidden");
    div_hidden.classList.add("vedi_likes");

    const main = document.querySelector("main");
    main.classList.add("oscurato");

    const frase = document.createElement("p");
    frase.textContent = "Mi piace messo da: ";

    for(element of json) {
        let nome = element.messo_da;
        let p_like = document.createElement("p");
        p_like.textContent = nome;
        div_hidden.appendChild(frase);
        div_hidden.appendChild(p_like);
    }
    const button = document.createElement("button");
    button.textContent = 'chiudi';
    div_hidden.appendChild(button);

    button.addEventListener('click', ritorno);
}

function ritorno(event) {
    const but = event.currentTarget;
    but.removeEventListener('click', ritorno);
    const div_hidden = but.parentElement;

    div_hidden.classList.add("hidden");
    div_hidden.classList.remove("vedi_likes");
    div_hidden.innerHTML = '';

    const main = document.querySelector("main");
    main.classList.remove("oscurato");

    const all_buttons = document.querySelectorAll("button");
    for (button of all_buttons) {
        if(button.value == 'Mi piace') {
            button.addEventListener('click', IDontLikeIt);
        }
        else {
            button.addEventListener('click', ILikeIt);
        }
    }
}