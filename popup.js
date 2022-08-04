const openButton = document.querySelectorAll('[data-popup-target]')
const closeButton = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay');
var app = document.getElementById('app');


openButton.forEach(button => {
    button.addEventListener('click' , () => {
        const pop = document.querySelector(button.dataset.popupTarget)
        openPopup(pop)
    })
})
closeButton.forEach(button => {
    button.addEventListener('click' , () => {

        const pop = button.closest('.popup')
        closePopup(pop)
    })
})

function openPopup(pop) {

    if(pop == null) return
    pop.classList.add('active')
    overlay.classList.add('active')

}

function closePopup(pop) {
    if(pop == null) return
    pop.classList.remove('active')
    overlay.classList.remove('active')
}




