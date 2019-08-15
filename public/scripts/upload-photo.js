let buttonSharePhoto = document.querySelectorAll( ".button-share-photo a" )
let sharePhoto = document.querySelector( "#share-photo" )
let body = document.querySelector( "body" )
let closeSharePhoto = document.querySelector( "#close-share-photo" )
// let overflowContainerSharePhoto = document.querySelector("#overflow-container-share-photo")
let containerSharePhotoForm = document.querySelector( "#container-share-photo-form" )
let containerUploadPhoto = document.querySelector( "#container-upload-photo" )
let labelUploadPhoto = document.querySelector( "#container-upload-photo label" )
let nombreRestantUpload = document.querySelector( ".nombre-upload" )
let cancelButton = document.querySelector( "#footer-share-photo-form input[type='reset']" )
let submitButton = document.querySelector( "#footer-share-photo-form input[type='submit']" )
let containerConfirmSharePhoto = document.createElement("div")
containerConfirmSharePhoto.id = "container-confirm-share-photo"
// const saveDomContainerSharePhotoForm = containerSharePhotoForm.innerHTML

/**********************************************************************/
/******* GESTION DE LA PAGE AU CHARGEMENT/RECHARGEMENT DE L'URL *******/
/**********************************************************************/

window.addEventListener( "DOMContentLoaded", ( event ) => {
	if (document.location.href === 'http://localhost:8888/projets/projet_3WA_Flo/Popup-v3/index.php?modal-upload#' ) {
    	showFormSharePhoto()
    }
})

window.addEventListener( "beforeunload", function ( e ) {
	if ( fileList.length ) {
		let confirmationMessage = "\o/";

		e.returnValue = confirmationMessage;     // Gecko, Trident, Chrome 34+
	 	return confirmationMessage;              // Gecko, WebKit, Chrome <34
	}
})

window.addEventListener( 'unload', function( e ){
	fileList.forEach( x => removeFileAtRefresh( x ) )
});

function removeFileAtRefresh(file) {
	let fd = new FormData()
	fd.append('fileName', file.name)

	navigator.sendBeacon("public/src/upload_photo/delete_UploadPhoto.php", fd)
}

/***************************************************************************************/
/******* ACTIONS UTILISATEUR POUR OUVRIR OU FERMER LE MODAL DE PARTAGE DE PHOTOS *******/
/***************************************************************************************/

// Ouvrir la fenêtre de partage de photos en cliquand sur le bouton "Partager une photo"
if (buttonSharePhoto) {
	buttonSharePhoto.forEach(x => {
		x.addEventListener( "click", function(){
			showFormSharePhoto()

			// Modifie l'url lorsque le modal d'upload de photos est affiché
			let stateObj = { index: "index?" }
			history.pushState(stateObj, "upload photos", "index.php?modal-upload")
		})
	})
}

// Fermer la fenêtre de partage de photos si on clique sur le bouton cancel du formulaire
cancelButton.addEventListener("click", function(e){
	e.preventDefault()
	closeUploadWindow()
})

// Fermer la fenêtre de partage de photos avec la touche echap (esc).
window.addEventListener("keydown", function (e) {
	e.keyCode == 27 ? closeUploadWindow() : null
})

// annuler le comportement du bouton de fermeture de la fenêtre (croix en haut à gauche)
closeSharePhoto.addEventListener("click", function(e){
	e.preventDefault()
})

// Fermer la fenêtre de partage de photos si on clique à l'exterieur (de la fenêtre).
sharePhoto.addEventListener("click", function(event){
	
	cursorPosition = getPosition(event)

	if ( cursorPosition.x < containerSharePhotoForm.offsetLeft
	|| cursorPosition.x > containerSharePhotoForm.offsetLeft + containerSharePhotoForm.offsetWidth
	|| cursorPosition.y < containerSharePhotoForm.offsetTop
	|| cursorPosition.y > containerSharePhotoForm.offsetTop + containerSharePhotoForm.offsetHeight 
	){
		closeUploadWindow()
	}
})

function getPosition( event ){
	let x = event.clientX /*( event.clientX - offsetcontainerSharePhoto.left )*/; // attention décalage du curseur si il y a une bordure;
	let y = event.clientY /*( event.clientY - offsetcontainerSharePhoto.top )*/;

	return { x, y };
}

function showFormSharePhoto(){
	sharePhoto.classList.remove("hide")
	sharePhoto.classList.add("show")
	body.classList.add("hide-scrollbar")
}

function closeUploadWindow() {
	if (fileList.length) {
		window.confirm("Fermer la fenêtre annulera tous les téléchargements." + "\n" + "Êtes-vous sûr de vouloir fermer?") ? hideFormSharePhoto() : null
	} else {
		hideFormSharePhoto()
	}
}

function hideFormSharePhoto(){
	containerConfirmSharePhoto.remove()
	sharePhoto.classList.add("hide")
	sharePhoto.classList.remove("show")
	body.classList.remove("hide-scrollbar")

	var stateObj = { index: "index?" };
	history.pushState(stateObj, "upload photos", "index.php");

	removeDisplay()
	fileList.forEach( x => removeFile(x) )

	fileList = []
	// visus = []
	xhrStatus = []
}
/*********************************************************************/
/******* DRAG AND DROP SUR LE MODAL (SECTION id="share-photo") *******/
/*********************************************************************/

let dropbox = sharePhoto;
let containerForm = document.querySelector("#container-share-photo-form")

let infoDragAndDrop = document.createElement("div")
infoDragAndDrop.id = "dragAndDrop"

let h1 = document.createElement("h1")
h1.textContent = "Déposez votre photo ici."
infoDragAndDrop.appendChild(h1)

let drag = document.createElement("div")
infoDragAndDrop.appendChild(drag)

dropbox.addEventListener("dragenter", dragenter, false);
dropbox.addEventListener("dragover", dragover, false);
dropbox.addEventListener("drop", drop, false);
drag.addEventListener("dragleave", dragleave, false);

function dragenter(e) {
	e.stopPropagation();
	e.preventDefault();
	containerForm.appendChild(infoDragAndDrop)
}

function dragover(e) {
	e.stopPropagation();
	e.preventDefault();
}

function dragleave(e) {
	e.stopPropagation();
	e.preventDefault();
	infoDragAndDrop.remove()
}

function drop(e) {
	e.stopPropagation();
	e.preventDefault();
	infoDragAndDrop.remove()

	let dt = e.dataTransfer;
	let files = dt.files;

	handleFiles(files);
}

/***********************************************************/
/********************* UPLOAD D'IMAGES *********************/
/***********************************************************/

/****************** DECLARATION DES VARIABLES GLOBALES, ET INITIALISATION DU DOM ******************/
window.URL = window.URL || window.webkitURL;

let upload = document.querySelector( "input[type='file']#upload-photo" )
upload.addEventListener( "change", handleFiles, false )

// let infosUpload = document.querySelector( "#box2-upload-photo" )
let preview = document.createElement( "div" )
preview.id = "preview"

let list = document.createElement( "div" )
list.classList.add( "list" )
let listColonnes = []

// Creation de 3 colonnes pour l'affichage des uploads
for ( let i = 0; i < 3; i++ ) {
	let colonne = document.createElement( "div" )
	colonne.classList.add( "colonne" )
	listColonnes.push( colonne )
	list.appendChild( colonne )
}
preview.appendChild( list )

let maxSizeFile = 15728640   // Taille max en octets du fichier (15728640 octets / 1048576 octets ( => 1Mo) = 15Mo)
let typeFile = "image/jpeg"  // Extensions autorisees
let maxWidthFile = 10000      // Largeur max de l'image en pixels
let maxHeightFile = 10000     // Hauteur max de l'image en pixels

let resetUploadFiles = upload.files
let fileList = []
let visus = []
let xhrStatus = []

/****************** INSERTION DES FICHIERS ET VERIFICATIONS CÔTE CLIENT ******************/
function handleFiles( files = null ) {
	let thisFiles
	this.files ? thisFiles = this.files : thisFiles = files
	
	if ( !thisFiles.length ) {
		alert( "Aucun(s) fichier(s) sélectionné(s) !" )
	}else if ( fileList.length < 10 ){
		Array.from( thisFiles ).forEach( x => {
			let img = new Image
			img.src = URL.createObjectURL(x)
			img.onload = () => { 
				// console.log(x)
				// console.log("width : " + img.width)
				// console.log("height : " + img.height)

				if ( x.type == typeFile ) {
					if ( x.size <= maxSizeFile ) {
						if ( img.width <= maxWidthFile ) {
							if ( img.height <= maxHeightFile ) {
								!fileList.length ? createDisplay() : null
								fileList.push(x)
								updateImageDisplay(x)
							}else{
								alert('La photo chargée est trop haute!' + "\n" + '(maximum autorisé : ' + maxheightFile + 'px.)')
							}
						}else{
							alert('La photo chargée est trop large!' + "\n" + '(maximum autorisé : ' + maxWidthFile + 'px.)')
						}
					}else{
						alert('La photo chargée est trop volumineuse!' + "\n" + '(maximum autorisé : ' + maxSizeFile / 1048576 + ' Mo.)')
					}
				}else{
					alert('Le fichier à uploader n\'est pas une image, ou l\'extension du fichier est incorrecte !' + "\n" + '(extension autorisée : ' + typeFile +')')
				}
			}
		})
	}else{
		alert( "Vous avez atteint le maximum de 10 photos téléchargées!" )
	}
	upload.files = resetUploadFiles
}

/******* AFFICHER LES INFORMATIONS DU FICHIER *******/
function updateImageDisplay( file ) {
	// On crée le container (visuel) qui va contenir l'image
	let visu = document.createElement( "div" )
	visu.classList.add( "visu" )

	/****** On affiche les miniatures d'images sélectionnées par l'utilisateur ******/
	let img = document.createElement( "img" )
	img.src = window.URL.createObjectURL( fileList[ fileList.indexOf( file ) ] )
	img.file = file
	img.style.maxWidth = "100%"
	img.onload = function() {
		window.URL.revokeObjectURL( fileList[ fileList.indexOf( file ) ].src )
	}
	visu.appendChild( img )
	createButton( visu, img )

	// On ajoute le visuel de l'image sélectionnée dans un tableau de tous les visuels en cours d'envoi
	visus.push( visu )

	// On affiche le nombre d'upload possible restant
	nombreRestantUpload.textContent = 10-visus.length

	// On affiche le nombre d'upload à publier
	fileList.length == 1 ? submitButton.value = "Publier " + fileList.length + " photo" : submitButton.value = "Publier " + fileList.length + " photos"

	// On affiche les visuels des images séletionnées dans la colonne correspondante
	listColonnes[ visus.indexOf( visu ) % listColonnes.length ].appendChild( visu )

	// On upload les images sur le serveur
	sendFile( img )
}


/****************** UPLOAD DU FICHIER SUR LE SERVEUR ******************/
function sendFile( img ) {
	let canvas = createThrobber( img );
	
	let fd = new FormData()
    fd.append( 'fichier', img.file )

	let uri = "public/src/upload_photo/upload_photo.php"
    let xhr = new XMLHttpRequest()

    // On désactive le bouton submit
    submitButton.setAttribute( "disabled", "" )

    // pendant le chargement de l'upload :
    xhr.upload.addEventListener( "progress", function( e ) {
		if ( e.lengthComputable ) {
			let percentage = Math.round( ( e.loaded * 100 ) / e.total )

			// Le canvas évolue proportionnellement au chargement de la requête
        	canvas.style.width = ( 100 - percentage ) + "%"
        }
    }, false );
  	
  	// Quand l'upload est terminée :
	xhr.upload.addEventListener( "load", function( e ){
		canvas.style.width = "0";
        canvas.parentNode.removeChild( canvas );

        //***** On affiche les informations des images téléchargées *****//
        let info = document.createElement( "p" )
        info.innerHTML = fileList[ fileList.indexOf( img.file ) ].name 
        				+ "<br>" 
        				+ returnFileSize( fileList[ fileList.indexOf( img.file ) ].size ) + '.'		
		img.parentNode.appendChild( info )
		
		// Description facultative
		fileList[ fileList.indexOf(img.file) ].description = ""

        //***** On modifie le bouton pour supprimer l'image téléchargée sur le serveur *****//
        removeFileButton( img )
	}, false );
	
	// Si il y a une erreur pendant le transfert du fichier  :
	xhr.upload.addEventListener("error", function (e) {
		alert("Une erreur est survenue pendant le transfert du fichier.")
	}, false);
    
    xhr.open( "POST", uri, true )
    xhr.onreadystatechange = function() {
        if ( xhr.readyState == 4 && xhr.status == 200 ) {

            // Handle response.
            xhr.responseText ? alert( xhr.responseText ) : null

        	// On vérifie si toutes les XHR envoyées sont terminées, pour activer le bouton submit
			// !xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length 
			// 	? submitButton.removeAttribute("disabled") : null
			if (!xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length) {
				submitButton.removeAttribute("disabled")
				xhrStatus = []
			}
        }
    };
	xhrStatus.push( xhr )
    xhr.send( fd )

    //***** Annule la requête en cours de chargement *****//
    cancelUploadButton( img, xhr )
}

/****************** SUPPRESSION DU FICHIER SUR LE SERVEUR ******************/
function removeFile( file ) {
    let uri = "public/src/upload_photo/delete_UploadPhoto.php"
    let xhr = new XMLHttpRequest()
    
    let fd = new FormData()
    
    xhr.open( "POST", uri, true )
    xhr.onreadystatechange = function() {
        if ( xhr.readyState == 4 && xhr.status == 200 ) {
            // Handle response.
			xhr.responseText ? alert( xhr.responseText ) : null

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

    fd.append( 'fileName', file.name )
    // Initiate a multipart/form-data upload
    xhr.send( fd )
}


/***********************************************************/
/****************** FONCTIONS UTILITAIRES ******************/
/***********************************************************/

function createDisplay() {
	containerUploadPhoto.appendChild(preview)
	// infosUpload.remove()
}

function createButton(element, img) {
	let div1 = document.createElement("div")
	div1.classList.add("div1")
	div1.style.zIndex = "10"
	element.appendChild(div1)

	let div2 = document.createElement("div")
	div2.classList.add("div2")
	div1.appendChild(div2)

	let div3 = document.createElement("div")
	div3.classList.add("div3")

	let button = document.createElement("button")
	button.className = "button"

	let iconeButton = document.createElement("i")
	iconeButton.className = "fas fa-times"

	div2.appendChild(button)
	div2.appendChild(div3)
	button.appendChild(iconeButton)

	button.addEventListener("click", function (e) {
		e.preventDefault()
		removeImageDisplay(img.file)
	})
}

function removeImageDisplay(file) {
	visus.map(x => x.remove())
	visus = visus.filter(x => visus.indexOf(x) !== fileList.indexOf(file))
	visus.map(x => listColonnes[visus.indexOf(x) % 3].appendChild(x))

	fileList.splice(fileList.indexOf(file), 1)
	nombreRestantUpload.textContent = 10 - fileList.length
	
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
		return number + ' octets';
	} else if (number >= 1024 && number < 1048576) {
		return (number / 1024).toFixed(1) + ' Ko';
	} else if (number >= 1048576) {
		return (number / 1048576).toFixed(1) + ' Mo';
	}
}

function createThrobber(img) {
	let canvas = document.createElement("canvas")
	canvas.className = "canvas"
	img.parentNode.appendChild(canvas)

	let ctx = canvas.getContext('2d');
	canvas.style.position = "absolute";
	canvas.style.right = "0";
	canvas.style.width = "100%";
	canvas.style.height = "100%";

	ctx.fillStyle = 'rgba( 255, 255, 255, 0.6 )';
	ctx.fillRect(0, 0, canvas.width, canvas.height);

	return canvas
}

function cancelUploadButton(img, xhr) {
	let cancelUploadButton = img.nextSibling.firstChild.firstChild
	let div3 = img.nextSibling.firstChild.lastChild
	div3.innerHTML = "Annuler"

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
	let div3 = img.nextSibling.firstChild.lastChild
	div3.innerHTML = "Supprimer"

	removeFileButton.addEventListener("click", function (e) {
		removeFile(img.file)
	})
}


/*************************************************************************/
/************ ENVOI VERS LA BDD DES INFOS DES PHOTOS UPLOADEES ************/
/*************************************************************************/

submitButton.addEventListener( "click", ( e ) => {
	e.preventDefault()
	removeDisplay()
	
	containerConfirmSharePhoto.innerHTML = ""
	containerSharePhotoForm.appendChild(containerConfirmSharePhoto)
	let img = document.createElement("img")
	img.src = "public/images/ajax-loader.gif"
	img.style.width = "15rem"
	img.style.margin = "auto"
	containerConfirmSharePhoto.append(img)

	setTimeout(() => {
		prepareToSendDb()
	}, 10);
})

function prepareToSendDb(){
	fileList.forEach(x => {
		let post =
		{
			"name": x.name,
			"description": x.description,
			"type": x.type,
			"size": x.size,
			"lastModified": x.lastModified,
			"lastModifiedDate": x.lastModifiedDate,
			"webkitRelativePath": x.webkitRelativePath
		}
		sendToDb(post)
	})
}

function sendToDb( informations ) {
	let json_upload = "json_upload=" + JSON.stringify(informations);
	
	let uri = "public/src/upload_photo/add_photo.php";
	let xhr = new XMLHttpRequest()

	xhr.open("POST", uri, true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.onreadystatechange = function () {
		
		if (xhr.readyState == 4 && xhr.status == 200) {
			// Handle response.
			xhr.responseText ? alert(xhr.responseText) : null
		}

		// On vérifie si toutes les XHR envoyées sont terminées pour vider le tableau des XHR envoyées
		if (!xhrStatus.filter(x => x.readyState != 4).length && !xhrStatus.filter(x => x.status != 200).length) {
			fileList = []
			xhrStatus = []
			setTimeout(() => {
				confirmSharePhoto()
			}, 2000);
		}
	};

	xhrStatus.push(xhr) // On pousse chaque requête envoyée dans un tableau des requêtes en cours envoyées
	xhr.send( json_upload )
}

function confirmSharePhoto (){
	containerConfirmSharePhoto.innerHTML = ""
	containerConfirmSharePhoto.innerHTML = "<h1>Merci d'avoir partagé!</h1>"+
										"<p>Votre photo est en cours de révision par la communauté et sera bientôt partagée sous la licence Popup.</p>"+
										"<p>Au nom de tous, nous vous remercions</p>"+
										"<p>"+
											"<a href='#' class='button'>Voir votre profil <i class='fas fa-long-arrow-alt-right'></i></a>"+
										"</p>"
}

