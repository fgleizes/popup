let publishNow = document.querySelector("#now")
let planifier = document.querySelector("#planifier")
let divPublishDate = document.querySelector("#divPublishDate")
let publishDate = document.querySelector("#publishDate")
// let publishHours = document.querySelector("#publishHours")
// let publishMinutes = document.querySelector("#publishMinutes")

publishNow.checked = true

planifier.addEventListener("change", function(){
    divPublishDate.classList.add("show")
	publishDate.required = true
})

publishNow.addEventListener("change", function(){
    divPublishDate.classList.remove("show");
	publishDate.required = false
	publishDate.value = ""
    planifier.checked = false
})

publishDate.addEventListener("click", function(){
	// planifier.checked = true
	// publishDate.required = true
	// publishNow.checked = false
})