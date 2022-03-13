let supprimerEt = document.querySelectorAll('.modal-trigger')
for (let bouton of supprimerEt) {
    bouton.addEventListener("click", function () {
        document.querySelector(".modal-footer a").href = `/admin/deleteEtudiant/${this.dataset.id}`
        document.querySelector(".modal-content").innerText = `Confirmer la suppression de ${this.dataset.prenom}`
    })
}
let supprimerProf = document.querySelectorAll('.modal-trigger')
for (let bouton of supprimerProf) {
    bouton.addEventListener("click", function () {
        document.querySelector(".modal-footer a").href = `/admin/deleteProf/${this.dataset.id}`
        document.querySelector(".modal-content").innerText = `Confirmer la suppression de ${this.dataset.prenom}`
    })
}