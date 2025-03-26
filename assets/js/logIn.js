function checkInput(ev){
    let valid = true;
    document.querySelectorAll('.login-form>input').forEach(el=>{
        if(!el.value.trim()){
            el.classList.add('input-invalid');
            valid = false;
        }else {
            el.classList.remove('input-invalid');
        }
    });
    if(!valid){
        ev.preventDefault();
    }
}

document.querySelector('#button-logIn').addEventListener('click', (ev)=>{
    checkInput(ev);
})
document.querySelectorAll('.login-form>input').forEach(el=>{
    el.addEventListener('change', (ev)=>{
        el.classList.remove('input-invalid');
    })
})