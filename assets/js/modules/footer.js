export class Footer{
    constructor(footer){
        this.footer=footer;
        this.createFooter();
    }
    createFooter(){
        this.footer.insertAdjacentHTML('afterbegin', 
            `<div class="footer">
            <span><a href="#">Blog</a></span>
            <span><a href="#">Contact</a></span>
            <span><a href="#">Help</a></span>
            <span><a href="#">Media</a></span>
            <span><a href="#">Media</a></span>
        </div>`
        )
    }
}