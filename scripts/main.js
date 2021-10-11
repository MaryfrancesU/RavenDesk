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

function deleteProj(projid){
    $.ajax({
        url: "../scripts/delproject.inc.php",		//page containing php you want to run
        type: "POST",						        //request type
        data : {projectid: projid},				    //data to be sent to the server
        success: function(response){		        //function to be called if the request succeeds
            console.log("delete success");
            location.reload();
        }			
    })
}

function renameProj(){
    alert("Rename function not yet available.");
}