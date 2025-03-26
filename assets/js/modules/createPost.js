export class CreatePost{
    constructor(text, id_user = 1){
        this.text = text;
        this.id_user = id_user;
        this.char = 140;
        this.options = ['Bold', 'Italic', 'Underline', 'Strikethrough'];
        this.createToolsBar();
        this.upLoadImgInPut = document.querySelector('#upLoadImg');
        this.UpLoadImage();
        this.charLeft();
        this.modifText();
        this.init();
        // console.log(this.text);
    }
    
    
    createToolsBar(){
            this.text.classList.add('createPost-module');
            this.text.insertAdjacentHTML('afterbegin', `
            <div class="createPost-inPutText" contenteditable="true" maxlength="140" placeholder="What is happening Octopus?" id="createPost-inPutText"></div>
            <div class="loadedImgs" id="loadedImgs"></div>        
            <div class="createPost-settings">
                        <div class="upLoadImg-container">
                            <input type="file" name="upLoadImg" id="upLoadImg" class="upLoadImg-input" >
                            <lable for="upLoadImg"><img src="../../assets/img/icon/upLoad-img.png" alt="upLoadImg icon" class="upLoadImg-img"></lable>
                        </div>                        
                        <div class="createPost-toolBar" id="toolbar">
                                <button type="button" class="toolBar-btn" id="Bold" ><b>B</b></button>
                                <button type="button" class="toolBar-btn" id="Italic"><i>I</i></button>
                                <button type="button" class="toolBar-btn" id="Underline"><u>U</u></button>
                                <button type="button" class="toolBar-btn" id="Strikethrough"><s>S</s></button>
                        </div>
                        <div class="createPost-char-left"><span id="charLeft">${this.char}</span></div>
                        <button type="button" class="button createPost-btn-post">POST</button>
                    </div>
            `)

    }

    // countPhoto(){
    //     let count = document.querySelector('#loadedImgs').querySelectorAll('div');
    //     console.log('count:',count);
    // } 
    UpLoadImage(){
        document.querySelector('.upLoadImg-img').addEventListener('click', function(){
            document.querySelector('#upLoadImg').click();
            
        })
        document.querySelector('#upLoadImg').addEventListener('change', function(){
            console.log(this.files);
            let image = this.files[0];
            if(image.size< 2000000){
                let fileInput = document.querySelector('#upLoadImg');
    let file = fileInput.files[0];
    console.log('file: ', file)
    if (!file) {
        alert("Choose File");
        return;
    }

    let formData = new FormData();
    formData.append("file", file);

    fetch("../../app/Controllers/HomeControllers.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // console.log(data.success);
            console.log(data.image_url);
            document.querySelector('#loadedImgs').insertAdjacentHTML('beforeend',
                `<div class="loadedImgs-loadedImgsItem">
                    <img alt="image load" src="${data.image_url}" data-src="${data.image_url}">
                </div>
                `
            )
            if(document.querySelector('#loadedImgs').querySelectorAll('div').length==4){
                document.querySelector('#upLoadImg').disabled = true;
            }
            // document.getElementById("preview").src = data.image_url;
            // document.getElementById("preview").style.display = "block";
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
    charLeft(){
        document.querySelector('#createPost-inPutText').addEventListener('input', event=>{
            let textInPut = event.target.firstChild.length ? event.target.firstChild.length : 0;
            // console.log("textinput",textInPut)
            // console.log(textInPut.length);
            document.querySelector('#charLeft').innerHTML = 140-textInPut;
        })
    }    
    textItalic() {
        let selection = window.getSelection();
        console.log(selection);        
        let range = selection.getRangeAt(0);
        let parentElement = range.startContainer.parentElement;
        console.log(parentElement)
        if (parentElement.nodeName === 'I') {
            parentElement.replaceWith(parentElement.textContent);
        } else {
            let i = document.createElement('i');
            i.textContent = range.toString();
            range.deleteContents();
            range.insertNode(i);
        }
    }
    textBold(text) {
        let selection = window.getSelection();
        let range = selection.getRangeAt(0);
        let parentElement = range.startContainer.parentElement;
    
        if (parentElement.nodeName === 'B') {
            parentElement.replaceWith(parentElement.textContent);
        } else {
            let b = document.createElement('b');
            b.textContent = range.toString();
            range.deleteContents();
            range.insertNode(b);
        }
    }
    textStrikethrough() {
        let selection = window.getSelection();
        let range = selection.getRangeAt(0);
        let parentElement = range.startContainer.parentElement;
    
        if (parentElement.nodeName === 'S') {
            parentElement.replaceWith(parentElement.textContent);
        } else {
            let s = document.createElement('s');
            s.textContent = range.toString();
            range.deleteContents();
            range.insertNode(s);
        }
    }
    textUnderline(text) {
        let selection = window.getSelection();
        let range = selection.getRangeAt(0);
        let parentElement = range.startContainer.parentElement;
    
        if (parentElement.nodeName === 'U') {
            parentElement.replaceWith(parentElement.textContent);
        } else {
            let u = document.createElement('u');
            u.textContent = range.toString();
            range.deleteContents();
            range.insertNode(u);
        }
    }
    appliquerStyle(style) {
        console.log(this.text)
        if (style === "Bold") {
            this.textBold(document.querySelector('#createPost-inPutText'));
        } else if (style === "Italic") {
            this.textItalic(document.querySelector('#createPost-inPutText'));
        } else if (style === "Underline") {
            this.textUnderline(document.querySelector('#createPost-inPutText'));
        } else if (style === "Strikethrough") {
            this.textStrikethrough(document.querySelector('#createPost-inPutText'));
        }
        console.log('sss: ',document.querySelector('#createPost-inPutText').innerHTML)
    }
    modifText(){        
        document.querySelectorAll('.toolBar-btn').forEach((item)=>{
            item.addEventListener('click',(event)=>{
                // console.log(event.target.id);
                this.appliquerStyle(event.target.id);
            })            
        })
    }
    sentPost(){
        console.log('id: ', document.querySelector('main').dataset.iduser)
        let data = {
            id_user: +document.querySelector('main').dataset.iduser,
            content: document.querySelector('#createPost-inPutText').innerHTML.toString(),
            media: {}
        }
        let img = 1;
        if(document.querySelector('#loadedImgs').querySelectorAll('div img').length>0){
            document.querySelector('#loadedImgs').querySelectorAll('div img').forEach((item)=>{
                // let name = 'media' + toString(img);
                data.media[img] = item.dataset.src;
                // console.log("media send", data.media[img])
                img++;
            })           

        }
        fetch('../../app/Controllers/CreatePostControllers.php', {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify(data)
        }).then(function(response){
            return response.text();
        }).then(function(data){
            console.log(data)
        })
        document.querySelector('#createPost-inPutText').innerHTML = "";
        document.querySelector('#loadedImgs').innerHTML = "";
        document.querySelector('#charLeft').innerHTML = 140;
        document.querySelector('#upLoadImg').disabled = false;
        // window.location.reload();

    }  
    init(){
        document.querySelector('.createPost-btn-post').addEventListener('click', (event)=>{
            // console.log("ClicSS")
            this.sentPost();
            
        });
        // console.log('btn post',document.querySelector('.createPost-btn-post'));
    } 
}