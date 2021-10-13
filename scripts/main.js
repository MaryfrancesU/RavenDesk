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



function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
  
    //Get all the tab content and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    //Get all the tablinks and make them not active (resetting activeness)
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    evt.currentTarget.className += " active";
  
    if(tabName == 'characters'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("chartab").style.display = "block";
      document.getElementById(tabName).style.display = "block";
    }
    else {
      document.getElementById("tabmenu").style.width = "30%";
      document.getElementById("chartab").style.display = "none";
      document.getElementById(tabName).style.display = "block";
    }    
}
  
  
  function openSubTab(evt, subTabName) {
    //hide other tab content
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    //deselect other buttons
    tablinks = document.getElementsByClassName("ctablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    //now get the tab content with the cityname and display it
    document.getElementById(subTabName).style.display = "block";
    evt.currentTarget.className += " active";
  }


  function updateBlurb(event) {
    var newblurb = event.currentTarget.value;
    $.ajax({
        url: "../scripts/blurb.inc.php",
        type: "POST",	
        data : {newblurb: newblurb},
        success: function(response){
            console.log("update blurb success");
        }			
    })
}