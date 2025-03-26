export class showPosts{
    constructor(area, arrPosts){
        this.area = area;
        this.arrPosts = JSON.parse(arrPosts);
        this.init();
        console.log(this.arrPosts);
        
    }
    
    

    
    showPost(item){        
        let arrMedia = item.media;
        console.log(item);
        // console.log('arrMedia', arrMedia);
        this.area.querySelector('#showPostContainer').insertAdjacentHTML('beforeend',
            `<div class="post" date-id_post="${item.id}">
                        <div class="post-userInfo" date-id_owner="${item.id_user}">
                            <div class="post-userInfo-pic block-icon"><img src="${item.picture}" alt="owner photos"></div>
                            <div class="post-userInfo-info">
                                <span class="post-userInfo-display-name" id="post-userInfo-display-name">${item.display_name}</span>
                                <span class="post-userInfo-username" id="post-userInfo-username">@${item.username}</span>
                                <span class="post-userInfo-creation_date" id="post-userInfo-creation_date">${item.creation_date}</span>
                            </div>
                        </div>
                        <div class="post-content">
                            <div class="post-content-text" id="post-content-text">
                                <p>${item.content}</p>
                            </div>
                            <div class="post-content-pics" id="post-content-pics" data-arrPhotos="${arrMedia}"><div class="post-content-btn btn-prev" id="post-btn-prev"><img src="../../assets/img/icon/icon-arrow-prev.png" alt="arrow previous"></div><img src="${arrMedia[0]}" alt="img from post"  data-post_id=${item.id} id="content-post-img"><div class="post-content-btn btn-next" id="post-btn-next"><img src="../../assets/img/icon/icon-arrow-next.png" alt="arrow next"></div>

                        </div>
                        <div class="post-interactiv">
                            <ul class="post-interactiv-list">
                                <li class="post-interactiv-item"><img src="../../assets/img/icon/icon-comment.svg" alt="icon comments"><span class="post-interactiv-comments" >17</span></li>
                                <li class="post-interactiv-item"><img  id="retweet" src="../../assets/img/icon/icon-repost.svg" alt="icon repost"><span class="post-interactiv-reposts" >13</span></li>
                                <li class="post-interactiv-item"><svg id="heart" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#B99FA9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21s-6-4.35-9-7.35C0 10 1.5 5.5 6 5.5c2.4 0 3.83 1.62 4.5 3 0.67-1.38 2.1-3 4.5-3 4.5 0 6 4.5 3 8.15-3 3-9 7.35-9 7.35z"/>
                                    </svg>
                                        <span class="post-interactiv-likes">78</span>
                                </li>
                                <li class="post-interactiv-item"><svg id="bookMarks" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#B99FA9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3h18v18H3V3z" />
                                    <path d="M7 3v6h10V3" />
                                    <path d="M7 15h10" />
                                    <path d="M9 18h6" />
                                    </svg>
                                        <span class="post-interactiv-bookmarks"></span>
                                </li>
                            </ul>
                        </div>
                    </div>`
        )
        console.log(arrMedia.length);
        if(arrMedia.length > 1){
            document.querySelectorAll(`[date-id_post="${item.id}"] .post-content-btn`).forEach(item=>{
                item.style.display = 'block';
            })
        }
    };
    createPostContainer(){
        this.area.insertAdjacentHTML('beforeend', `
            <div class="showPosts-container" id="showPostContainer">                    
                </div>
            `);
        this.arrPosts.forEach(item => {
            
            item.media = [];            
            for(let i=1; i<=4;i++){
                let name = "media" + i;
                // console.log("media", item[name])
                if(item[name] !== null){
                    // console.log(item[name])
                    item.media.push(item[name]);
                }
            }
            this.showPost(item);
        });
    }
    nextImg(event){
        let imgPost = event.target.closest('#post-content-pics').querySelector('#content-post-img');
                let arr = event.target.closest('#post-content-pics').dataset.arrphotos.split(',');
                // console.log(arr);
                let srcCurrent = imgPost.getAttribute('src');
                // console.log("srcCur",srcCurrent)
                let imgId = arr.indexOf(srcCurrent);
                imgId++;
                console.log(imgId);
                if(imgId<arr.length){
                    imgPost.src = arr[imgId];
                }else{
                    imgPost.src = arr[0];
                }
    }
    prevImg(event){
        let imgPost = event.target.closest('#post-content-pics').querySelector('#content-post-img');
                let arr = event.target.closest('#post-content-pics').dataset.arrphotos.split(',');
                // console.log(arr);
                let srcCurrent = imgPost.getAttribute('src');
                // console.log("srcCur",srcCurrent)
                let imgId = arr.indexOf(srcCurrent);
                imgId--;
                console.log(imgId);
                if(imgId== -1){
                    imgPost.src = arr[arr.length-1];
                }else{
                    imgPost.src = arr[imgId];
                }
    }
    caruselPhoto(){
        document.querySelectorAll('#post-btn-next').forEach(item=>{
            item.addEventListener('click', event=>{
                this.nextImg(event);
            })
        })
        document.querySelectorAll('#post-btn-prev').forEach(item=>{
            item.addEventListener('click', event=>{
                this.prevImg(event);
            })
        })
    }
    interactivPost(){
        
    }
    init(){
        // console.log('arr Post',this.arrPosts);
        if(this.arrPosts == null){            
            return;
        }else{
            this.createPostContainer();
        }
        this.caruselPhoto();
        this.interactivPost();
    }
}
console.log('Show post')


