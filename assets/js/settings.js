console.log("SETTINGS");
let theme = {
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
function checkPassword(){
    if(document.querySelector('#settings-password-input').value===document.querySelector('#settings-password-confirm').value){
        return true
    }else{
        return false
    }
}
function chengePassword(){
    // console.log(document.querySelector('#settings-password'))
    let data = {
        user_id: document.querySelector('#settings-password').dataset.userid,
        oldPassword: document.querySelector('#settings-password-old').value,
        newPassword: document.querySelector('#settings-password-input').value
    }
    // console.log("inJS",data)
    fetch('../../app/Controllers/SettingsControllers.php', {
        "method": "POST",
        "headers": {
            "Content-Type": "application/json; charset=utf-8"
        },
        "body": JSON.stringify(data)
    }).then(function(response){
        return response.text();
    }).then(function(data){
        // console.log(JSON.parse(data));
        // console.log(JSON.parse(data).success);
        // console.log('2',JSON.parse(data)['success']);
        if(JSON.parse(data).success == 'true'){
            alert('Your Password was changed!')
        }else{
            alert("Your Password wasn't changed!")
        }
    })
    delete data.user_id;
    delete data.oldPassword;
    delete data.newPassword;
}
function checkEmail(){
    if(!document.querySelector('#settings-email-input').value.trim()){
        return false
    }else{
        return true
    }
}
function changeEmail(){
    if(checkEmail()){
        // console.log('checkEmail+');
        let data = {
            user_id: document.querySelector('#settings-email').dataset.userid,
            email: document.querySelector('#settings-email-input').value
        }
        // console.log(data);
        fetch('../../app/Controllers/SettingsControllers.php', {
            "method": "POST",
            "headers": {
            "Content-Type": "application/json; charset=utf-8"
        },
        "body": JSON.stringify(data)
        }).then(function(response){
            return response.text();
        }).then(function(data){
            // console.log(JSON.parse(data));
            // console.log(JSON.parse(data).success);
            // console.log('2',JSON.parse(data)['success']);
            if(JSON.parse(data).success == 'true'){
                alert('Your Email was changed!')
            }else{
                alert("Your Email wasn't changed!")
            }
        })
        delete data.user_id;
        delete data.email;
    }else{
        alert("The email field is empty or incorrect!")
    }    
}

function upDatetheme(){
    const myTheme = JSON.parse(localStorage.getItem('theme'));
    root = document.documentElement;
    // console.log('myTheme', myTheme);
    for(key in myTheme){
        root.style.setProperty(key, myTheme[key]);
    }
    
    
    
    
}
function changeTheme(){
    let themeCur = document.querySelector('#settings-theme-select').value;
    // console.log(theme)
    switch(themeCur){
        case 'classic':
            theme['--color-pink-light']= '#C92667';
            theme['--color-pink-dark']= '#941e4d';
            theme['--color-ping-hover']= '#E0154F';
            theme['--color-pink-activ']= '#d21a4f';
            theme['--color-main-bg']= '#500F29';
            theme['--color-white']= '#FFFFFF';
            theme['--color-dark']= '#000000';
            theme['--color-gray-light']= '#E1E1E1';
            theme['--color-gray-dark']= '#808080';
            theme['--color-gray']= '#b2b2b2';
            theme['--color-ic-bd']= '#B99FA9';
            theme['--color-bg-post']= '#3d0e21c7';
            
            break
        case 'white':
            theme['--color-pink-light']= '#171717';
            theme['--color-pink-dark']= '#B3B3B3';
            theme['--color-ping-hover']= '#171717';
            theme['--color-pink-activ']= '#171717';
            theme['--color-main-bg']= '#000';
            theme['--color-white']= '#fff';
            theme['--color-dark']= '#000';
            theme['--color-gray-light']= '#E1E1E1';
            theme['--color-gray-dark']= '#808080';
            theme['--color-gray']= '#b2b2b2';
            theme['--color-ic-bd']= '#747474';
            theme['--color-bg-post']= '#332E2E';
            
            break
        case 'blue':
            theme['--color-pink-light']= '#000E82';
            theme['--color-pink-dark']= '';
            theme['--color-ping-hover']= '#1AD3F0';
            theme['--color-pink-activ']= '#fff';
            theme['--color-main-bg']= '#00084E';
            theme['--color-white']= '#FFFFFF';
            theme['--color-dark']= '#000000';
            theme['--color-gray-light']= '#E1E1E1';
            theme['--color-gray-dark']= '#808080';
            theme['--color-gray']= '#b2b2b2';
            theme['--color-ic-bd']= '#8084A7';
            theme['--color-bg-post']= '#080E48';            
            break

    }
    // console.log('theme', theme);
    // console.log(JSON.stringify(theme));
    localStorage.setItem('theme', JSON.stringify(theme));
    upDatetheme();
}
document.querySelector('#settings-logOut-btn').addEventListener('click',(event)=>{
    let confirmLogOut = confirm('Are you sure you want to LOG OUT?');
    if(confirmLogOut){
        window.location.href = "../../index.html"
    }
})
document.querySelector('.settings-password-btn').addEventListener('click', (event)=>{
    if(!checkPassword()){
        alert("Check the passwords, they are different")
    }else{
        chengePassword();
    }
    document.querySelectorAll('.settings-password-form input').forEach((item)=>{
        item.value="";
    })
})
document.querySelector('#select-theme-btn').addEventListener('click', changeTheme);
document.querySelector('#settings-email-btn').addEventListener('click', changeEmail);
upDatetheme();
// ----------ИЗМЕНЕНИЕ  :ROOT----------
// const root = document.documentElement;
// let currentColor = getComputedStyle(root).getPropertyValue('--color-white');
// console.log("color",currentColor);
// root.style.setProperty('--color-white', '#000');
// currentColor = getComputedStyle(root).getPropertyValue('--color-white');
// console.log("color2",currentColor);