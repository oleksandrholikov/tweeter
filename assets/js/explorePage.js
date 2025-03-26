let search = document.querySelector('#search');
let result = document.querySelector('#result');
const data = {};
async function getData() {
    if (search.value == " " || search.value == "") {
        console.log("empty");
        result.innerHTML = "";
    }
    if(search.value[0] == "@" || search.value[0] == "#") {
        data.info = search.value;
        // console.log(data.info);
        await fetch('../../app/Controllers/ExploreController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.text())
        .then(res => {
            // console.log('Response from server: ', res)
            result.innerHTML = res;
            let resultGroup = document.querySelectorAll('.profilInfo');
            // console.log(resultGroup);
            resultGroup.forEach(element => {
                element.querySelector('#subscribe').addEventListener('click', function() {
                    // console.log(element);
                    let idUser = document.querySelector('.profilInfo-Info-name').id;
                    // console.log(idUser);
                    let idUserFollowed = element.id;
                    const folow = {
                        "id_user": idUser,
                        "id_user_followed": idUserFollowed
                    }
                    async function inscription() {
                        await fetch('../../app/Controllers/SubscriptionController.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(folow)
                        })
                        .then(response=> response.text())
                        .then(reqResult => {
                            console.log('Response from server: ' + reqResult);
                            if (reqResult == "subscribed" || reqResult == "unsubscribed") {
                                element.querySelector('#subscribe').textContent = reqResult == "subscribed" ? "Unsubscribe" : "Subscribe";
                            }
                        })
                    }
                    inscription();
                })
            });
        })
    }

}
search.addEventListener('input', getData);