const form = document.querySelector('#singUp-form');
const allInput = document.querySelectorAll('#singUp-form > input');
const buttonSingUp = document.querySelector('#button-singUp');
const inputPass = document.querySelector('#password');
const inputPassConfirm = document.querySelector('#confirm-password');
const backGround = document.querySelector('#background-menu');
const blockUserName = document.querySelector('#block-userName');
const buttonCreateuserName= document.querySelector('#createUserName');
const blockAddPhoto = document.querySelector('#block-photo');
const inPutFullName = document.querySelector('#fullname');
const buttonAddPhoto = document.querySelector('#addPhoto');
const blockBio = document.querySelector('#block-bio');
const buttonAddBio = document.querySelector('#addBio');


console.log('SingUp');
console.log(form);
console.log(allInput);
console.log(buttonSingUp);
const singUpArr = {

}


function confirmPassWord(ev){    
    if(inputPass.value !== inputPassConfirm.value){
        alert("The password doesn't the same!");
        ev.preventDefault();
        inputPassConfirm.classList.add('input-invalid')
        return false
    }else{
        return true
    }
}
function checkFullName(){
    let nameArr = inPutFullName.value.trim().split(' ');
    if (nameArr.length == 2){
        return true;
    }else{
        alert("write your FIRST and LAST name separated by a space")
        return false
    }
}
function userNameOpen(){
    backGround.classList.add('display-action');
    backGround.classList.remove('display-hidden');
    blockUserName.classList.add('display-action');
    blockUserName.classList.remove('display-hidden');
}
function upLoadPics(){
    document.querySelector('#lable-photo').addEventListener('click', function(){
        document.querySelector('#photo-input').click();
        
    })
    document.querySelector('#photo-input').addEventListener('change', function(){
        console.log(this.files);
        let image = this.files[0];
        if(image.size< 2000000){
            let fileInput = document.querySelector('#photo-input');
    let file = fileInput.files[0];
    console.log('file: ', file)
    if (!file) {
        alert("Choose File");
    return;
    }

    let formData = new FormData();
    formData.append("file", file);

    fetch("../../app/Controllers/SignUpController.php", {
            method: "POST",
            body: formData
            })
            .then(response => response.json())
            .then(data => {
            if (data.success){
        // console.log(data.success);
            // console.log("img_url",data.image_url);
            document.querySelector('#block-photo').style.backgroundImage=`url(${data.image_url})`;
            // document.querySelector('#lable-photo').classList.remove('hover');
            singUpArr.picture =  data.image_url;
            // console.log('3', singUpArr)

            } else {
                alert("Error: " + data.error);
            }
    })
    .catch(error => console.error("Error:", error));
        }else{
            alert("Image size more than 2MB");
        }
    })
}
function openAddPhoto(){
    backGround.classList.add('display-action');
    backGround.classList.remove('display-hidden');
    blockUserName.classList.remove('display-action');
    blockUserName.classList.add('display-hidden');
    blockAddPhoto.classList.add('display-action');
    blockAddPhoto.classList.remove('display-hidden');
    upLoadPics();
}
function checkInput(ev){
    let valid = true;    
    if(!confirmPassWord(ev)){
        valid = false;        
    };
    if(!checkFullName()){
        valid = false; 
    }
    
    
       
    // console.log('1') 
    // console.log('valid befor:',valid);
    document.querySelectorAll('#singUp-form>input').forEach(el=>{
    // console.log(el.value)
        if(!el.value.trim()){
            // console.log(el.value)
            el.classList.add('input-invalid');
            valid = false;
        }else {
            el.classList.remove('input-invalid');
        }
    }); 
    // console.log('valid after:',valid);
    if(!valid){
        // console.log('2')
        ev.preventDefault();
        }else{
        // console.log("opnnuserNmae")
        singUpArr.fullname = document.querySelector('#fullname').value;
        singUpArr.email = document.querySelector('#email').value;
        singUpArr.password = document.querySelector('#password').value;
        singUpArr.birthday = document.querySelector('#birthday').value;
        // console.log('1:', singUpArr);
        
        userNameOpen();
    }
}
// document.querySelector('#singUp-form').addEventListener('submit', (event)=>{
//     let valid = true;   
//     console.log('1') 
//     console.log('valid befor:',valid);
//             allInput.forEach(el=>{
//                 console.log(el.value)
//                 if(!el.value.trim()){
//                     // console.log(el.value)
//                     el.classList.add('input-invalid');
//                     valid = false;
//                 }else {
//                     el.classList.remove('input-invalid');
//                 }
//             }); 
//             console.log('valid after:',valid);
//             if(!valid){
//                 console.log('2')
//                 event.preventDefault();
//             }else{
//                 console.log("opnnuserNmae")
//                 userNameOpen();
//             }
// });
function addNewUser(){
    console.log('4:', singUpArr);
    singUpArr.post = 'true';
    fetch('../../app/Controllers/SignUpController.php', {
        "method": "POST",
            "headers": {
                "Content-Type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify(singUpArr)
        }).then(function(response){
            return response.text();
        }).then(function(data){
            console.log(data);
            window.location.href= './LoginView.php';
        })
}
buttonSingUp.addEventListener('click', (ev)=>{
    
    checkInput(ev);
})
allInput.forEach(el=>{
    el.addEventListener('change', (ev)=>{
        el.classList.remove('input-invalid');
    });
})
buttonCreateuserName.addEventListener('click', (event)=>{
    if(!document.querySelector('#username').value.trim()){
        event.preventDefault();
        document.querySelector('#username').classList.add('input-invalid');
        alert("Write your username!it's a must")
    }else{
        singUpArr.username=document.querySelector('#username').value[0] ==='@'? document.querySelector('#username').value.substring(1):document.querySelector('#username').value;
        // console.log('2:', singUpArr);
        openAddPhoto();
    }
})
buttonAddPhoto.addEventListener('click', ()=>{
    blockBio.classList.add('display-action');
    blockBio.classList.remove('display-hidden');
    blockAddPhoto.classList.remove('display-action');
    blockAddPhoto.classList.add('display-hidden');      
});
buttonAddBio.addEventListener('click', ()=>{
    singUpArr.bio = document.querySelector('#bio-input').value;
    
    addNewUser();
});