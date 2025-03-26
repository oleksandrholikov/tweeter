const buttonLogIn = document.querySelector('#button-LogIn');
const buttonSignUp = document.querySelector('#button-signUp');

buttonLogIn.addEventListener('click', ()=>{
    console.log('click 1')
    window.location.href = 'app/Views/LoginView.php';
})

buttonSignUp.addEventListener('click', ()=>{
    console.log('click 2')
    window.location.href = 'app/Views/SignUpView.php';
})
console.log('ICI')
// import{Footer} from './modules/footer.js';
// let footer = new Footer(document.querySelector('footer'));