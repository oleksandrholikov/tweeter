import{showPosts} from './modules/showPosts.js';

const buttonfollowing = document.querySelector('#following');
const buttonfollowers = document.querySelector('#followers');
const buttonEditProfil = document.querySelector('#btn-edit-profil');
const buttonEditExit = document.querySelector('#exit-edit');
const profilEditBlock = document.querySelector('#profil-edit-block');
const bgMenu = document.querySelector('#background-menu');
const buttonSave = document.querySelector('#btn-form-edit');
const editInfo = {
    'edit': 'true',
    'id_user': +document.querySelector('main').dataset.iduser
};
let showPost;
let imgURL;
// console.log(buttonEditProfil);

function upLoadNewInfo(){
    fetch('../../app/Controllers/ProfilController.php', {
        "method": "POST",
            "headers": {
                "Content-Type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify(editInfo)
        }).then(function(response){
            return response.text();
        }).then(function(data){
            if(JSON.parse(data).success){
                alert("Your Profil was upDated!");
                buttonEditExit.click();
                location.reload();
            }else{
                alert("Your Profil wasn't upDated! Try again!");
            }            
        })
}     

document.querySelectorAll('.profil-nav-item').forEach((item)=>{
    // console.log('item',item)
    item.addEventListener('click',(event)=>{
        document.querySelectorAll('.profil-nav-item').forEach(el=>{
            el.classList.remove('underline');            
        })
        document.querySelectorAll('.profil-posts-resalt-item').forEach(el=>{
            el.classList.remove('display-action');
            el.classList.add('display-hidden');
            el.querySelector('.showPosts').innerHTML = '';
        })
        let dataItem = event.target.dataset.item;
        switch(dataItem){
            case "posts":
                event.target.classList.add('underline');
                document.querySelector('#user-posts').classList.add('display-action');
                document.querySelector('#user-posts').classList.remove('display-hidden');
                showPost = new showPosts(document.querySelector('#showPosts-posts'), document.querySelector('#showPosts-posts').dataset.posts);
                break
            case "likes":
                event.target.classList.add('underline');
                document.querySelector('#user-likes').classList.add('display-action');
                document.querySelector('#user-likes').classList.remove('display-hidden');
                showPost = new showPosts(document.querySelector('#showPosts-likes'), document.querySelector('#showPosts-likes').dataset.posts);
                break
            case "bookmarks":
                event.target.classList.add('underline');
                document.querySelector('#user-bookmarks').classList.add('display-action');
                document.querySelector('#user-bookmarks').classList.remove('display-hidden');
                showPost = new showPosts(document.querySelector('#showPosts-bookmarks'), document.querySelector('#showPosts-bookmarks').dataset.posts);
                break
        }
    })
})
function editProfil(){
    editInfo.firstname = document.querySelector('#firstname').value.trim()? document.querySelector('#firstname').value: "null";
    editInfo.lastname = document.querySelector('#lastname').value.trim()? document.querySelector('#lastname').value: "null";
    editInfo.biography = document.querySelector('#biography').value.trim()? document.querySelector('#biography').value: "null";
    editInfo.city = document.querySelector('#city').value.trim()? document.querySelector('#city').value: "null";
    editInfo.country = document.querySelector('#country').value.trim()? document.querySelector('#country').value: "null";
    editInfo.phone = document.querySelector('#phone').value.trim()? document.querySelector('#phone').value: "null";
    editInfo.url = document.querySelector('#url').value.trim()? document.querySelector('#url').value: "null";
    editInfo.header = document.querySelector('#header').value != '#000000'? document.querySelector('#header').value: "null";
    if(!document.querySelector('#picture').value.trim()){
        editInfo.picture = "null";
    }else{
        editInfo.picture = imgURL;
    }
    console.log(editInfo); 
    upLoadNewInfo();
}
buttonEditProfil.addEventListener('click', ()=>{
    profilEditBlock.classList.remove('display-hidden');
    profilEditBlock.classList.add('display-action');
    bgMenu.classList.remove('display-hidden');
    bgMenu.classList.add('display-action');
})
buttonEditExit.addEventListener('click',()=> {
    profilEditBlock.classList.add('display-hidden');
    profilEditBlock.classList.remove('display-action');
    bgMenu.classList.remove('display-action');
    bgMenu.classList.add('display-hidden');
})

buttonSave.addEventListener('click',()=>{
    if(editProfil()){
        document.querySelectorAll('#profil-edit-form input').forEach((item)=>{
            item.value="";
        })
    }
});
document.querySelector('#picture').addEventListener('change', function(){
    console.log(this.files);
    let image = this.files[0];
    if(image.size< 2000000){
    let fileInput = document.querySelector('#picture');
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
                    imgURL = data.image_url;
                } else {
                    alert("Error: " + data.error);
                }
    })
    .catch(error => console.error("Error:", error));
        }else{
            alert("Image size more than 2MB");
        }
});
buttonfollowing.addEventListener('click', ()=>{
    window.location.href = 'FollowersView.php';
})

buttonfollowers.addEventListener('click', ()=>{
    window.location.href = 'FollowingView.php';
})