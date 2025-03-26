let twets = document.querySelectorAll(".post");
twets.forEach(element => {
    element.querySelector('#bookMarks').addEventListener('click', function() {
        let idUser = document.querySelector('.profilInfo-Info-name').id;
        let idPost = element.getAttribute('date-id_post');
        const data = {
            "id_user": idUser,
            "id_post": idPost
        }
        async function getData() {
            await fetch('../../app/Controllers/BookMarksController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.text())
                .then(res => {
                    console.log('Response from server: ', res);
                    element.querySelector('#bookMarks').style.fill = `${res}`;
                    element.querySelector('#bookMarks').style.stroke = `black`;
            })
            
        }
        getData();
    })
});