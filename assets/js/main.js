import {CreatePost} from './modules/createPost.js';
import{Footer} from './modules/footer.js';
import{showPosts} from './modules/showPosts.js';
let defaultTheme = {
    '--color-pink-light':'#C92667',
    '--color-pink-dark': '#941e4d',
    '--color-ping-hover': '#E0154F',
    '--color-pink-activ': '#d21a4f',
    '--color-main-bg': '#500F29',
    '--color-white': '#FFFFFF',
    '--color-dark': '#000000',
    '--color-gray-light': '#E1E1E1',
    '--color-gray-dark': '#808080',
    '--color-gray': '#b2b2b2',
    '--color-ic-bd': '#B99FA9',
    '--color-bg-post': '#3d0e21c7'
};
let theme = JSON.parse(localStorage.getItem('theme')) || defaultTheme;

let root = document.documentElement;

// Применяем стили из localStorage или по умолчанию
for (let key in theme) {
    root.style.setProperty(key, theme[key]);
}

if(document.querySelector('#createPost')){
    let cPost = new CreatePost(document.querySelector('#createPost'));
}
if(document.querySelector('footer')){
    let footer = new Footer(document.querySelector('footer'));
}
if(document.querySelector('#showPosts')){
    let showPost = new showPosts(document.querySelector('#showPosts'), document.querySelector('#showPosts').dataset.posts);
}


function changePage(ev){
    if(window.location.href.includes(ev.target.dataset.page)){
        ev.preventDefault();
    }else{
        let page =  ev.target.dataset.page;
        switch(page){
            case "Home":
                window.location.href = './HomeView.php';
                break;
            case "Explore" :
                window.location.href = './ExploreView.php';
                break;
            case "Messages" :
                window.location.href = './MessagesView.php';
                break;
            case "Profil" :
                window.location.href = './ProfilView.php';
                break;
            case "Settings" :
                window.location.href = './SettingsView.php';
                break;        
        }
    }
    console.log(ev.target.dataset.page);
    console.log('name: ', ev.target.innerText);
    console.log(typeof(window.location.href));
}


document.querySelectorAll('.navigation-item a').forEach((item)=>{
    item.classList.remove('underline');    
    if(window.location.href.includes(item.dataset.page)){
        item.classList.add('underline');
    }
    item.addEventListener('click', (ev)=>{
        changePage(ev);
    })
})
console.log('MAIN.JS')

