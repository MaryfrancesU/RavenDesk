function addProject() {
    var modal = document.getElementById("addProjectModal");
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }

}

function closeModal(modalID) {
    var modal = document.getElementById(modalID);
    modal.style.display = "none";

}
