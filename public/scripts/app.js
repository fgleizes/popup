let modal = null
const focusableSelector = "button:enabled, a, textarea, select, input" /* **input** : Element input[type="file"] retiré des éléments focusable car focus inutile dans le sytème */
let focusableElements = []
let previouslyFocusedElement = null

const openModal = function (e) {
    e.preventDefault()
    modal = document.querySelector(e.currentTarget.getAttribute('href'))
    focusableElements = Array.from(modal.querySelectorAll(focusableSelector))
    previouslyFocusedElement = document.querySelector(':focus')
    modal.style.display = null
    focusableElements[0].focus()
    modal.removeAttribute('aria-hidden')
    modal.setAttribute('aria-modal', 'true')
    modal.addEventListener('click', closeModal)
    modal.querySelectorAll('.js-modal-close').forEach(button => button.addEventListener('click', closeModal))
    modal.querySelector('.js-modal-stop').addEventListener('click', stopPropagation)
}

const closeModal = function (e) {
    if (modal === null) return
    if (previouslyFocusedElement !== null) previouslyFocusedElement.focus()
    e.preventDefault() 
    modal.setAttribute('aria-hidden', 'true')
    modal.removeAttribute('aria-modal')
    modal.removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-close').removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop').removeEventListener('click', stopPropagation)
    const hideModal = function () {
        modal.style.display = "none"
        modal.removeEventListener('animationend', hideModal)
        modal = null
    }
    modal.addEventListener('animationend', hideModal)
}

const stopPropagation = function (e) {
    e.stopPropagation()
}

const focusInModal = function (e) {
    e.preventDefault()
    let index = focusableElements.findIndex(f => f === modal.querySelector(':focus'))
    // if (e.shiftKey === true) {
    //     index--
    // } else {
    //     index++
    // }
    // if (index >= focusableElements.length) {
    //     index = 0
    // }
    // if (index < 0) {
    //     index = focusableElements.length - 1
    // }
    e.shiftKey === true ? index-- : index++
    index >= focusableElements.length ? index = 0 : null
    index < 0 ? index = focusableElements.length - 1 : null
    focusableElements[index].focus()
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
