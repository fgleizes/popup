/***********************************************************/
/********************* VERSION MOBILE **********************/
/****************** AFFICHAGE DES THEMES *******************/
/***********************************************************/
var categoriesIsOpen = false

const toggleCategories = function (e) {
    e.preventDefault()
    if (categoriesIsOpen) {
        document.querySelector('#nav-mobile .container-list-themes').style.display = null
        document.querySelector('.nav-mobile').style.height = "5rem"
        document.querySelector('header').style.marginTop = "5rem"
        
        categoriesIsOpen = false
    } else {
        document.querySelector('#nav-mobile .container-list-themes').style.display = "block"
        document.querySelector('.nav-mobile').style.height = "9rem"
        document.querySelector('header').style.marginTop = "9rem"
        categoriesIsOpen = true
    }
}

document.querySelectorAll('.js-toggle-categories').forEach(a => {
    a.addEventListener('click', toggleCategories)
})

/***********************************************************/
/********************* TOUTES VERSIONS *********************/
/********************** MODAL UPLOAD ***********************/
/***********************************************************/
var asideExist = document.querySelector('aside#modal-share-photos')
if (asideExist !== null) {
    
    let modal = null
    const focusableSelector = "button:enabled, a, textarea, select, input"
    let focusableElements = []
    let previouslyFocusedElement = null
    let stateObj = { index: window.location.href };

    let scrollPosition
    // let html = document.querySelector("html")
    // let body = document.querySelector("body")

    const openModal = function (e) {
        e.preventDefault()
        history.replaceState(stateObj, window.location.href, window.location.href + "#modal-share-photos");
        previouslyFocusedElement = document.querySelector(':focus')
        modal = document.querySelector(e.currentTarget.getAttribute('href'))
        showModal(modal)
    }

    const showModal = function (modal) {
        // scrollPosition = window.scrollY
        // window.addEventListener("scroll", stopScroll);

        // document.querySelector("html").style.position = "fixed"
        // document.querySelector("html").style.width = "100%"

        // document.querySelector("body").style.position = "fixed"
        // document.querySelector("body").style.width = "100%"

        // document.ontouchmove = function (event) {
        //     event.preventDefault();
        // }

        // document.addEventListener("touchmove", preventDefault)
        
        document.body.style.overflowY = "hidden"
        focusableElements = Array.from(modal.querySelectorAll(focusableSelector))
        modal.style.display = null
        focusableElements[0].focus()
        modal.removeAttribute('aria-hidden')
        modal.setAttribute('aria-modal', 'true')
        modal.addEventListener('click', closeModal)
        modal.querySelectorAll('.js-modal-close').forEach(button => button.addEventListener('click', closeModal))
        modal.querySelector('.js-modal-stop').addEventListener('click', stopPropagation)
        upload.addEventListener("change", handleFiles, false)
    }

    const closeModal = function (e) {
        if (modal === null) return
        if (previouslyFocusedElement !== null) previouslyFocusedElement.focus()
        e.preventDefault()
        history.replaceState(stateObj, window.location.href, window.location.pathname + window.location.search);
        if (fileList.length) {
            window.confirm("Fermer la fenêtre annulera tous les téléchargements." + "\n" + "Êtes-vous sûr de vouloir fermer?") ? hideModal(modal) : null
        } else {
            hideModal(modal)
        }
    }

    const hideModal = function (modal) {
        // window.scrollY = scrollPosition
        // window.removeEventListener('scroll', stopScroll)
        
        // document.querySelector("html").style.position = null
        // document.querySelector("html").style.width = null

        // document.querySelector("body").style.position = null
        // document.querySelector("body").style.width = null

        // document.removeEventListener("touchmove", preventDefault)

        document.body.style.overflowY = null
        modal.setAttribute('aria-hidden', 'true')
        modal.removeAttribute('aria-modal')
        modal.removeEventListener('click', closeModal)
        modal.querySelector('.js-modal-close').removeEventListener('click', closeModal)
        modal.querySelector('.js-modal-stop').removeEventListener('click', stopPropagation)

        removeDisplay()
        fileList.forEach(x => removeFile(x))
        fileList = []
        xhrStatus = []

        containerConfirmSharePhoto.remove()

        const hide = function () {
            modal.style.display = "none"
            modal.removeEventListener('animationend', hide)
            // document.body.style.overflowY = null
            modal = null
        }
        modal.addEventListener('animationend', hide)
    }

    const stopPropagation = function (e) {
        e.stopPropagation()
    }

    // const preventDefault = function (e) {
    //     e.preventDefault()
    // }

    // const stopScroll = function (e) {
    //     // window.scrollY = scrollPosition
    //     window.scrollTo(0, scrollPosition)
    // }

    const focusInModal = function (e) {
        e.preventDefault()
        let index = focusableElements.findIndex(f => f === modal.querySelector(':focus'))
        if (e.shiftKey === true) {
            index--
        } else {
            index++
        }
        if (index >= focusableElements.length) {
            index = 0
        }
        if (index < 0) {
            index = focusableElements.length - 1
        }
        // e.shiftKey === true ? index-- : index++
        // index >= focusableElements.length ? index = 0 : null
        // index < 0 ? index = focusableElements.length - 1 : null
        // focusableElements[index].focus()
    }

    document.querySelectorAll('.js-modal').forEach(a => {
        a.addEventListener('click', openModal)
    })

    window.addEventListener('keydown', function (e) {
        if (e.key === "Escape" || e.key === "Esc") {
            closeModal(e) 
        }
        if (e.key === 'Tab' && modal !== null) {
            focusInModal(e)
        }
        // e.key === "Escape" || e.key === "Esc" ? closeModal(e) : null
        // e.key === "Tab" && modal !== null ? focusInModal(e) : null
    })

    /**********************************************************************/
    /******* GESTION DE LA PAGE AU CHARGEMENT/RECHARGEMENT DE L'URL *******/
    /**********************************************************************/
    
    var chemin
    if (window.location.pathname.match('index.php')){
        chemin = ''
    } else {
        chemin = '../'
    }

    window.addEventListener("DOMContentLoaded", (e) => {
        if (window.location.href.endsWith('#modal-share-photos')) {
            modal = document.querySelector('#modal-share-photos')
            showModal(modal)
        }
    })

    window.addEventListener("beforeunload", function (e) {
        if (fileList.length) {
            let confirmationMessage = "\o/";

            e.returnValue = confirmationMessage;     // Gecko, Trident, Chrome 34+
            return confirmationMessage;              // Gecko, WebKit, Chrome <34
        }
    })

    window.addEventListener('unload', function (e) {
        fileList.forEach(x => removeFileAtRefresh(x))
    });

    function removeFileAtRefresh(file) {
        let fd = new FormData()
        fd.append('fileName', file.name)

        // let uri = window.location.origin + "/Popup2/public/src/upload_photo/delete_UploadPhoto.php"
        let uri = chemin + "src/upload_photo/delete_UploadPhoto.php"

        // navigator.sendBeacon("/projets/popup/public/src/upload_photo/delete_UploadPhoto.php", fd)
        navigator.sendBeacon(uri, fd)
    }

    /*********************************************************************/
    /******* DRAG AND DROP SUR LE MODAL (ASIDE id="#modal-share-photo") *******/
    /*********************************************************************/

    // let dropbox = document.querySelector("#modal-share-photos")
    // let dropbox = document.querySelector(".modal-wrapper")
    // let containerForm = document.querySelector("#container-share-photo-form")
    var containerSharePhotoForm = document.querySelector("#container-share-photo-form")

    var dragAndDrop = document.createElement("div")
    dragAndDrop.id = "dragAndDrop"

    var infoDragAndDrop = document.createElement("h1")
    infoDragAndDrop.textContent = "Déposez votre photo ici."
    dragAndDrop.appendChild(infoDragAndDrop)

    var drag = document.createElement("div")
    dragAndDrop.appendChild(drag)

    containerSharePhotoForm.addEventListener("dragenter", dragenter, false)
    containerSharePhotoForm.addEventListener("dragover", dragover, false)
    containerSharePhotoForm.addEventListener("drop", drop, false)
    drag.addEventListener("dragleave", dragleave, false)

    function dragenter(e) {
        e.stopPropagation()
        e.preventDefault()
        containerSharePhotoForm.appendChild(dragAndDrop)
    }

    function dragover(e) {
        e.stopPropagation()
        e.preventDefault()
    }

    function dragleave(e) {
        e.stopPropagation()
        e.preventDefault()
        dragAndDrop.remove()
    }

    function drop(e) {
        e.stopPropagation()
        e.preventDefault()
        dragAndDrop.remove()

        let dt = e.dataTransfer
        let files = dt.files

        handleFiles(files)
    }

    /***********************************************************/
    /********************* UPLOAD D'IMAGES *********************/
    /***********************************************************/

    /****************** DECLARATION DES VARIABLES GLOBALES, ET INITIALISATION DU DOM ******************/
    window.URL = window.URL || window.webkitURL

    // let containerSharePhotoForm = document.querySelector("#container-share-photo-form")
    var containerUploadPhoto = document.querySelector("#body-share-photo-form")
    var labelUploadPhoto = document.querySelector("#body-share-photo-form label")
    var nombreRestantUpload = document.querySelectorAll(".nombre-upload")
    var submitButton = document.querySelector("#valid-upload-photo")

    var containerConfirmSharePhoto = document.createElement("div")
    containerConfirmSharePhoto.id = "container-confirm-share-photo"

    var upload = document.querySelector("#upload-photo")
    // upload.addEventListener("change", handleFiles, false)

    var preview = document.createElement("div")
    preview.id = "preview"

    var list = document.createElement("div")
    list.classList.add("list")


    // Creation des colonnes pour l'affichage des uploads
    var nbColonnes
    var listColonnes

    if (window.matchMedia("(min-width: 992px)").matches) {
        // Ecran d'ordinateur
        nbColonnes = 3
    } else if (window.matchMedia("(min-width: 768px)").matches) {
        // Ecran de tablette
        nbColonnes = 2
    } else {
        // Ecran mobile
        nbColonnes = 1
    }

    const createColonne = function (nbColonnes) {
        for (let i = 0; i < nbColonnes; i++) {
            let colonne = document.createElement("div")
            colonne.classList.add("colonne")
            list.appendChild(colonne)
        }
        listColonnes = Array.from(list.querySelectorAll(".colonne"))
        preview.appendChild(list)
    }

    createColonne(nbColonnes)

    const resizePreviewList = function () {
        if (window.matchMedia("(min-width: 992px)").matches && nbColonnes !== 3) {
            listColonnes.forEach(colonne => colonne.remove())
            nbColonnes = 3
            createColonne(nbColonnes)
            visus.forEach(visu => displayImage(visu))
        } else if (window.matchMedia("(min-width: 768px)").matches && window.matchMedia("(max-width: 991px)").matches && nbColonnes !== 2) {
            listColonnes.forEach(colonne => colonne.remove())
            nbColonnes = 2
            createColonne(nbColonnes)
            visus.forEach(visu => displayImage(visu))
        } else if (window.matchMedia("(max-width: 767px)").matches && nbColonnes !== 1) {
            listColonnes.forEach(colonne => colonne.remove())
            nbColonnes = 1
            createColonne(nbColonnes)
            visus.forEach(visu => displayImage(visu))
        } 
    }

    window.onresize = resizePreviewList

   
    // for (let i = 0; i < 3; i++) {
    //     let colonne = document.createElement("div")
    //     colonne.classList.add("colonne")
    //     listColonnes.push(colonne)
    //     list.appendChild(colonne)
    // }
    // preview.appendChild(list)
    

    var maxSizeFile = 15728640   // Taille max en octets du fichier (15728640 octets / 1048576 octets( => 1Mo) = 15Mo)
    var typeFile = "image/jpeg"  // Extensions autorisees
    var maxWidthFile = 10000      // Largeur max de l'image en pixels
    var maxHeightFile = 10000     // Hauteur max de l'image en pixels

    var resetUploadFiles = upload.files
    var fileList = []
    var visus = []
    var xhrStatus = []

    /****************** INSERTION DES FICHIERS ET VERIFICATIONS CÔTE CLIENT ******************/
    function handleFiles(files = null) {
        let thisFiles
        this.files ? thisFiles = this.files : thisFiles = files

        // console.log("-------------------------------------")
        // console.log("this.files = " + this.files)
        // console.log(this.files)
        // console.log("-------------------------------------")
        // console.log("files = " + files)
        // console.log(files)
        // console.log("-------------------------------------")
        // console.log("upload.files = " + upload.files)
        // console.log(upload.files)
        // console.log("-------------------------------------")
        // console.log("thisFile = " + thisFiles)
        // console.log(thisFiles)
        // console.log("-------------------------------------")

        // if (thisFiles && !thisFiles.length) {
        //     alert("Aucun(s) fichier(s) sélectionné(s) !")
        //     console.log("Aucun(s) fichier(s) sélectionné(s) !")
        // }

        if (fileList.length < 10) {
            Array.from(thisFiles).forEach(x => {
                let img = new Image
                img.src = URL.createObjectURL(x)
                img.onload = () => {
                    // console.log(x)
                    // console.log("width : " + img.width)
                    // console.log("height : " + img.height)

                    if (x.type == typeFile) {
                        if (x.size <= maxSizeFile) {
                            if (img.width <= maxWidthFile) {
                                if (img.height <= maxHeightFile) {
                                    !fileList.length ? createDisplay() : null
                                    fileList.push(x)
                                    updateImageDisplay(x)
                                } else {
                                    alert('La photo chargée est trop haute!' + "\n" + '(maximum autorisé : ' + maxheightFile + 'px.)')
                                }
                            } else {
                                alert('La photo chargée est trop large!' + "\n" + '(maximum autorisé : ' + maxWidthFile + 'px.)')
                            }
                        } else {
                            alert('La photo chargée est trop volumineuse!' + "\n" + '(maximum autorisé : ' + maxSizeFile / 1048576 + ' Mo.)')
                        }
                    } else {
                        alert('Le fichier à uploader n\'est pas une image, ou l\'extension du fichier est incorrecte !' + "\n" + '(extension autorisée : ' + typeFile + ')')
                    }
                }
            })
        } else {
            alert("Vous avez atteint le maximum de 10 photos téléchargées!")
        }
        upload.files = resetUploadFiles
    }

    /******* AFFICHER LES INFORMATIONS DU FICHIER *******/
    function updateImageDisplay(file) {
        // On crée le container (visuel) qui va contenir l'image
        let visu = document.createElement("div")
        visu.classList.add("visu")

        /****** On affiche les miniatures d'images sélectionnées par l'utilisateur ******/
        let img = document.createElement("img")
        img.src = window.URL.createObjectURL(fileList[fileList.indexOf(file)])
        img.file = file
        img.style.width = "100%"
        img.onload = function () {
            window.URL.revokeObjectURL(fileList[fileList.indexOf(file)].src)
        }
        visu.appendChild(img)
        createButton(visu, img)

        // On ajoute le visuel de l'image sélectionnée dans un tableau de tous les visuels en cours d'envoi
        visus.push(visu)

        // On affiche le nombre d'upload possible restant
        nombreRestantUpload.forEach(x => x.textContent = 10 - visus.length)

        // On affiche le nombre d'upload à publier
        fileList.length == 1 ? submitButton.value = "Publier " + fileList.length + " photo" : submitButton.value = "Publier " + fileList.length + " photos"

        // On affiche les visuels des images séletionnées dans la colonne correspondante
        displayImage(visu)

        // On upload les images sur le serveur
        sendFile(img)
    }

    function displayImage(visu){
        listColonnes[visus.indexOf(visu) % nbColonnes].appendChild(visu)
    }

    /****************** UPLOAD DU FICHIER SUR LE SERVEUR ******************/
    function sendFile(img) {
        let canvas = createThrobber(img);

        let fd = new FormData()
        fd.append('fichier', img.file)

        // let uri = window.location.origin + "/Popup2/public/src/upload_photo/upload_photo.php"
        let uri = chemin + "src/upload_photo/upload_photo.php"
        let xhr = new XMLHttpRequest()

        // On désactive le bouton submit
        submitButton.setAttribute("disabled", "")

        // pendant le chargement de l'upload :
        xhr.upload.addEventListener("progress", function (e) {
            if (e.lengthComputable) {
                let percentage = Math.round((e.loaded * 100) / e.total)

                // Le canvas évolue proportionnellement au chargement de la requête
                canvas.style.width = (100 - percentage) + "%"
            }
        }, false);

        // Quand l'upload est terminée :
        xhr.upload.addEventListener("load", function (e) {
            canvas.style.width = "0";
            canvas.parentNode.removeChild(canvas);

            //***** On affiche les informations des images téléchargées *****//
            let info = document.createElement("p")
            info.innerHTML = fileList[fileList.indexOf(img.file)].name
            + "<br>"
            + returnFileSize(fileList[fileList.indexOf(img.file)].size) + '.'


            /********* NON UTILISE POUR LE MOMENT *********/
            // Description facultative
            fileList[fileList.indexOf(img.file)].description = ""

            // let descriptionPhoto = document.createElement("input")
            // info.appendChild(descriptionPhoto)
            // descriptionPhoto.type = 'textarea'
            // fileList[fileList.indexOf(img.file)].description = descriptionPhoto.value

            img.parentNode.appendChild(info)

            //***** On modifie le bouton pour supprimer l'image téléchargée sur le serveur *****//
            removeFileButton(img)
        }, false);

        // Si il y a une erreur pendant le transfert du fichier  :
        xhr.upload.addEventListener("error", function (e) {
            alert("Une erreur est survenue pendant le transfert du fichier.")
        }, false);

        xhr.open("POST", uri, true)
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                // Handle response.
                xhr.responseText ? alert(xhr.responseText) : null

                // On vérifie si toutes les XHR envoyées sont terminées, pour activer le bouton submit
                // !xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length 
                // 	? submitButton.removeAttribute("disabled") : null
                if (!xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length) {
                    submitButton.removeAttribute("disabled")
                    xhrStatus = []
                }
            }
        };
        xhrStatus.push(xhr)
        xhr.send(fd)

        //***** Annule la requête en cours de chargement *****//
        cancelUploadButton(img, xhr)
    }

    /****************** SUPPRESSION DU FICHIER SUR LE SERVEUR ******************/
    function removeFile(file) {
        // let uri = window.location.origin + "/Popup2/public/src/upload_photo/delete_UploadPhoto.php"
        let uri = chemin + "src/upload_photo/delete_UploadPhoto.php"
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

        fd.append('fileName', file.name)
        // Initiate a multipart/form-data upload
        xhr.send(fd)
    }


    /***********************************************************/
    /****************** FONCTIONS UTILITAIRES ******************/
    /***********************************************************/

    function createDisplay() {
        containerUploadPhoto.appendChild(preview)
        // infosUpload.remove()
    }

    function createButton(element, img) {
        let containerButtons = document.createElement("div")
        containerButtons.classList.add("container-buttons")
        element.appendChild(containerButtons)
        // containerButtons.style.zIndex = "10"

        let positionButtons = document.createElement("div")
        positionButtons.classList.add("position-buttons")
        containerButtons.appendChild(positionButtons)

        let infosButtons = document.createElement("div")
        infosButtons.classList.add("infos-buttons")

        let button = document.createElement("button")
        button.className = "button remove-upload-button"

        let iconeButton = document.createElement("i")
        iconeButton.className = "fas fa-times"

        positionButtons.appendChild(button)
        positionButtons.appendChild(infosButtons)
        button.appendChild(iconeButton)
        
        button.addEventListener("click", function (e) {
            e.preventDefault()
            removeImageDisplay(img.file)
        })

        // function createButton(element, img) {
        //     let div1 = document.createElement("div")
        //     div1.classList.add("div1")
        //     div1.style.zIndex = "10"
        //     element.appendChild(div1)

        //     let div2 = document.createElement("div")
        //     div2.classList.add("div2")
        //     div1.appendChild(div2)

        //     let div3 = document.createElement("div")
        //     div3.classList.add("div3")

        //     let button = document.createElement("button")
        //     button.className = "button"

        //     let iconeButton = document.createElement("i")
        //     iconeButton.className = "fas fa-times"

        //     div2.appendChild(button)
        //     div2.appendChild(div3)
        //     button.appendChild(iconeButton)

        //     button.addEventListener("click", function (e) {
        //         e.preventDefault()
        //         removeImageDisplay(img.file)
        //     })
        // }
    }

    function removeImageDisplay(file) {
        visus.map(visu => visu.remove())
        visus = visus.filter(visu => visus.indexOf(visu) !== fileList.indexOf(file))
        // visus.map(visu => listColonnes[visus.indexOf(visu) % 3].appendChild(visu))
        visus.map(visu => displayImage(visu))

        fileList.splice(fileList.indexOf(file), 1)
        nombreRestantUpload.forEach(x => x.textContent = 10 - visus.length)
        // nombreRestantUpload.textContent = 10 - fileList.length

        !fileList.length ? removeDisplay()
            : fileList.length == 1 ? submitButton.value = "Publier " + fileList.length + " photo"
                : submitButton.value = "Publier " + fileList.length + " photos"
    }

    function removeDisplay() {
        visus.map(x => x.remove())
        visus = []
        preview.remove()
        // labelUploadPhoto.appendChild(infosUpload)

        // fileList = []


        submitButton.value = "Publier sur Popup!"
        submitButton.setAttribute("disabled", "")
    }

    function returnFileSize(number) {
        if (number < 1024) {
            return number + ' octets'
        } else if (number >= 1024 && number < 1048576) {
            return (number / 1024).toFixed(1) + ' Ko'
        } else if (number >= 1048576) {
            return (number / 1048576).toFixed(1) + ' Mo'
        }
    }

    function createThrobber(img) {
        let canvas = document.createElement("canvas")
        canvas.className = "canvas"
        img.parentNode.appendChild(canvas)

        let ctx = canvas.getContext('2d')
        canvas.style.position = "absolute"
        canvas.style.right = "0"
        canvas.style.width = "100%"
        canvas.style.height = "100%"

        ctx.fillStyle = 'rgba( 255, 255, 255, 0.6 )'
        ctx.fillRect(0, 0, canvas.width, canvas.height)

        return canvas
    }

    function cancelUploadButton(img, xhr) {
        let cancelUploadButton = img.nextSibling.firstChild.firstChild
        let infosButtons = img.nextSibling.firstChild.lastChild
        infosButtons.innerHTML = "Annuler"

        cancelUploadButton.addEventListener("click", function (e) {
            xhr.abort()
            xhrStatus.splice(xhrStatus.indexOf(xhr), 1)

            // On vérifie si toutes les XHR envoyées sont terminées, pour activer le bouton submit
            if (xhrStatus.length) {
                // !xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length
                // 	? submitButton.removeAttribute("disabled") : null
                if (!xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length) {
                    submitButton.removeAttribute("disabled")
                }
            }
            // else{
            // 	submitButton.setAttribute("disabled", "")
            // }
        })
    }

    function removeFileButton(img) {
        let removeFileButton = img.nextSibling.firstChild.firstChild
        let infosButtons = img.nextSibling.firstChild.lastChild
        infosButtons.innerHTML = "Supprimer"

        removeFileButton.addEventListener("click", function (e) {
            removeFile(img.file)
        })
    }


    /*************************************************************************/
    /************ ENVOI VERS LA BDD DES INFOS DES PHOTOS UPLOADEES ************/
    /*************************************************************************/

    submitButton.addEventListener("click", (e) => {
        e.preventDefault()
        removeDisplay()

        containerConfirmSharePhoto.innerHTML = ""
        containerSharePhotoForm.appendChild(containerConfirmSharePhoto)
        let img = document.createElement("img")
        img.src = chemin + "public/images/ajax-loader.gif"
        img.style.width = "15rem"
        img.style.margin = "auto"
        containerConfirmSharePhoto.append(img)

        setTimeout(() => {
            prepareToSendDb()
        }, 10)
    })

    function prepareToSendDb() {
        fileList.forEach(x => {
            let post =
            {
                "name": x.name,
                "description": x.description,
                "type": x.type,
                "size": x.size,
                "lastModified": x.lastModified,
                // "lastModifiedDate": x.lastModifiedDate,
                "lastModifiedDate": new Date(x.lastModified).toLocaleString(),
                "webkitRelativePath": x.webkitRelativePath
            }
            sendToDb(post)
        })
    }

    function sendToDb(informations) {
        let json_upload = "json_upload=" + JSON.stringify(informations)

        // let uri = window.location.origin + "/Popup2/public/src/upload_photo/add_photo.php"
        let uri = chemin + "src/upload_photo/add_photo.php"
        let xhr = new XMLHttpRequest()

        xhr.open("POST", uri, true)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

        xhr.onreadystatechange = function () {

            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle response.
                xhr.responseText ? alert(xhr.responseText) : null
            }

            // On vérifie si toutes les XHR envoyées sont terminées pour vider le tableau des requêtes en cours
            if (!xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length) {
                fileList = []
                xhrStatus = []
                setTimeout(() => {
                    confirmSharePhoto()
                }, 2500)
            }
        };

        xhrStatus.push(xhr) // On pousse chaque requête envoyée dans un tableau des requêtes en cours
        xhr.send(json_upload)
    }

    function confirmSharePhoto() {
        containerConfirmSharePhoto.innerHTML = ""
        containerConfirmSharePhoto.innerHTML = "<h1>Merci d'avoir partagé!</h1>" +
                                                "<p>Votre photo est en cours de révision par la communauté et sera bientôt partagée sous la licence Popup.</p>" +
                                                "<p>Au nom de tous, nous vous remercions</p>" +
                                                "<p>" +
                                                    "<a href='" + chemin + "src/accountUser.php' class='button white-button'>Voir votre profil <i class='fas fa-long-arrow-alt-right'></i></a>" +
                                                "</p>"
    }
}