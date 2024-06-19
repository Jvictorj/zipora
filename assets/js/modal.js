const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");
const botao = document.querySelector(".btnmodal")




const openModalButtonmobile = document.querySelector("#open-modal-mobile");
const closeModalButtonmobile = document.querySelector("#close-modal-mobile");
const modalmobile = document.querySelector("#modal-mobile");
const fademobile = document.querySelector("#fade-mobile");
const botaomobile = document.querySelector(".btnmodal-mobile")



const toggleModal = () => {
    [modal, fade,].forEach((el) => el.classList.toggle("hide"));
};

[openModalButton, closeModalButton, fade, botao,].forEach((el) => {
    el.addEventListener("click", () => toggleModal());
;})