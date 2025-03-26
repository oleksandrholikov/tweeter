let twet = document.querySelectorAll(".post");
twet.forEach(element => {
    element.querySelector('#heart').addEventListener('click', function() {
        let idUser = document.querySelector('.profilInfo-Info-name').id;
        let idPost = element.getAttribute('date-id_post');
        const data = {
            "id_user": idUser,
            "id_post": idPost
        }
        async function getData() {
            await fetch('../../app/Controllers/LikeController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.text())
                .then(res => {
                    console.log('Response from server: ', res);
                    element.querySelector('#heart').style.fill = `${res}`;
                    element.querySelector('#heart').style.stroke = `black`;
            })
            
        }
        getData();
    })
});