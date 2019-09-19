let publishNow = document.querySelector("#now")
let planifier = document.querySelector("#planifier")
let divPublishDate = document.querySelector("#divPublishDate")
let publishDate = document.querySelector("#publishDate")

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
        let uri = "../src/admin_deletePhoto.php"
        let xhr = new XMLHttpRequest()

        let fd = new FormData()

        xhr.open("POST", uri, true)
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle response.
                xhr.responseText ? alert(xhr.responseText) : null
            }
        }

        fd.append('file_Id', file_Id)
        // Initiate a multipart/form-data upload
        xhr.send(fd)
    }
})

