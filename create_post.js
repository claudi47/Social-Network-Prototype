const form = document.forms['search'];
form.addEventListener('submit', ricerca);

function ricerca(event) {
    event.preventDefault();
    const form_data = {method: 'post', body: new FormData(form)};
    fetch('http://151.97.9.184/sicari_claudio/Homework1/HMW1/do_search_content.php', form_data).then(onResponse).then(onJson);
}

function onResponse(response) {
    return response.json();
}

function onJson(json) {
    const div_principale = document.querySelector("#principale");
    div_principale.innerHTML='';

    if (form.selezione.value == 'openlibrary') {
        let num_results = json.num_found;
        if(num_results > 12) {
            num_results = 12;
        }

        for (let i = 0; i < num_results; i++) {
            console.log(json);
            const libro = json.docs[i];
            const titolo = libro.title;
            const autore = libro.author_name;
            const isbn = libro.isbn[0];
            const cover = 'http://covers.openlibrary.org/b/isbn/' + isbn + '-M.jpg';
            
            const div = document.createElement("div");
            const img = document.createElement("img");
            const title = document.createElement("p");
            const author = document.createElement("p");
            const button = document.createElement("button");
            
            button.id = titolo;
            title.id = 'title';
            author.id = 'author';

            button.textContent = "Posta!";
            title.textContent = titolo;
            author.textContent = autore;
            img.src = cover;

            div.classList.add("book");
            div_principale.appendChild(div); 
            div.appendChild(img);
            div.appendChild(title);
            div.appendChild(author);
            div.appendChild(button);

            button.addEventListener("click", create_post);
        }
    }

    if (form.selezione.value == 'youtube') {
        console.log(json)

        for(let i = 0; i < 12; i++) {

            const video = json.items[i];
            const channel_title = video.snippet.channelTitle;
            const video_title = video.snippet.title;
            const video_thumbnail = video.id.videoId;

            const video_url = 'http://www.youtube.com/embed/' + video_thumbnail;
            
            const div = document.createElement("div");
            const img = document.createElement("iframe");
            img.setAttribute("allowfullscreen", "");
            const title = document.createElement("p");
            const author = document.createElement("p");
            const button = document.createElement("button");

            button.id = video_title;
            title.id = 'title';
            author.id = 'author';

            button.textContent = "Posta!";
            title.textContent = video_title;
            author.textContent = channel_title;
            img.src = video_url;

            div.classList.add("video");
            div_principale.appendChild(div); 
            div.appendChild(img);
            div.appendChild(title);
            div.appendChild(author);
            div.appendChild(button);

            button.addEventListener("click", create_post);
        }
    }
}

function create_post(event) {

    if (form.selezione.value == 'openlibrary') {
        const partenza = event.currentTarget;
        const contenuto = partenza.parentElement;
        const form2 = document.forms['create_post'];
    
        const img = contenuto.querySelector("img");
        form2.img.value = img.src;
        const title = contenuto.querySelector("p#title");
        form2.title.value = title.textContent;
        const author = contenuto.querySelector("p#author");
        form2.author.value = author.textContent;
        form2.tipo.value = 'openlibrary';
    
        const div_nascosto = document.querySelector("body .hidden");
        div_nascosto.classList.remove("hidden");
        div_nascosto.classList.add("box_post");
    
        const main = document.querySelector("main");
        main.classList.add("oscurato");
    
        const div_principale = document.querySelector("body div#principale");
        const buttons = div_principale.querySelectorAll("button");
        for (button of buttons) {
            button.removeEventListener("click", create_post);
        }

        const chiudi = div_nascosto.querySelector("#chiudi");
        chiudi.addEventListener('click', ritorna);
    }

    if(form.selezione.value == 'youtube') {
        const partenza = event.currentTarget;
        const contenuto = partenza.parentElement;
        const form2 = document.forms['create_post'];
    
        const img = contenuto.querySelector("iframe");
        form2.img.value = img.src;
        const title = contenuto.querySelector("p#title");
        form2.title.value = title.textContent;
        const author = contenuto.querySelector("p#author");
        form2.author.value = author.textContent;
        form2.tipo.value = 'youtube';
    
        const div_nascosto = document.querySelector("body .hidden");
        div_nascosto.classList.remove("hidden");
        div_nascosto.classList.add("box_post");
    
        const main = document.querySelector("main");
        main.classList.add("oscurato");
    
        const div_principale = document.querySelector("body div#principale");
        const buttons = div_principale.querySelectorAll("button");
        for (button of buttons) {
            button.removeEventListener("click", create_post);
        }
        const chiudi = div_nascosto.querySelector("#chiudi");
        chiudi.addEventListener('click', ritorna);
    }
}

function ritorna(event) {
    const butt = event.currentTarget;
    butt.removeEventListener('click', ritorna);
    const div_principale = document.querySelector("body div#principale");
    const buttons = div_principale.querySelectorAll("button");
    for (button of buttons) {
        button.addEventListener("click", create_post);
    }

    const div_nascosto = document.querySelector("body .box_post");
    div_nascosto.classList.remove("box_post");
    div_nascosto.classList.add("hidden");

    const main = document.querySelector("main");
    main.classList.remove("oscurato");
}