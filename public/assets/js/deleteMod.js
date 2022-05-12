
let supprimerModule = document.querySelectorAll('.modal-trigger')
for (let bouton of supprimerModule) {
    bouton.addEventListener("click", function () {
        document.querySelector(".modal-footer a").href = `/Admin/deleteModule/${this.dataset.id}`
        document.querySelector(".modal-content").innerText = `Confirmer la suppression de`
    })
}