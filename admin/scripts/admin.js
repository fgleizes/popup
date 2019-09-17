let publishNow = document.querySelector("#now")
let planifier = document.querySelector("#planifier")
let divPublishDate = document.querySelector("#divPublishDate")
let publishDate = document.querySelector("#publishDate")
// let publishHours = document.querySelector("#publishHours")
// let publishMinutes = document.querySelector("#publishMinutes")

publishNow.checked = true

planifier.addEventListener("change", function () {
    divPublishDate.classList.add("show")
    divPublishDate.classList.remove("hide")
    publishDate.required = true
})

publishNow.addEventListener("change", function () {
    divPublishDate.classList.remove("show");
    divPublishDate.classList.add("hide");
    publishDate.required = false
    publishDate.value = ""
    planifier.checked = false
})

// publishDate.addEventListener("click", function () {
//     // planifier.checked = true
//     // publishDate.required = true
//     // publishNow.checked = false
// })

let validPhoto = document.querySelector("#valid-photo")
let validPhotoForm = document.querySelector("#valid-photo form")
let deletePhoto = document.querySelector(".delete-button")
let confirmDeletePhoto

validPhotoForm.addEventListener("submit", function () {
    let loader = document.createElement("div")
    loader.className = "loader"
    validPhoto.appendChild(loader)
})

deletePhoto.addEventListener("click", function (){
    confirmDeletePhoto = confirm("Êtes-vous sûr(e) de vouloir supprimer cette photo ?")
    console.log(confirmDeletePhoto)
    if (confirmDeletePhoto) {
        let photo_Id = document.querySelector("#photo_Id").textContent
        console.log(photo_Id)
        removeFile(photo_Id)
    }
    /****************** SUPPRESSION DU FICHIER SUR LE SERVEUR ******************/
    function removeFile(file_Id) {
        // let uri = window.location.origin + "/Popup2/public/src/upload_photo/delete_UploadPhoto.php"
        let uri = "../src/admin_deletePhoto.php"
        let xhr = new XMLHttpRequest()

        let fd = new FormData()

        xhr.open("POST", uri, true)
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle response.
                xhr.responseText ? alert(xhr.responseText) : null

                // On vérifie si toutes les XHR de transfert de fichier envoyées sont terminées, pour activer le bouton submit
                // if (xhrStatus.length){
                // 	!xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length
                // 		? submitButton.removeAttribute("disabled") : null		
                // } 
                // else { // S'il n'y a plus de requete en cours on désactive le bouton submit
                // 	submitButton.setAttribute("disabled", "")
                // }
            }
        }

        fd.append('file_Id', file_Id)
        // Initiate a multipart/form-data upload
        xhr.send(fd)
    }
})

