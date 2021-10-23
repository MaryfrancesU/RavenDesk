function addProject() {
    var modal = document.getElementById("addProjectModal");
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }

}

function addArticle(){
  closeModal("addEncyclopediaModal");

	var articleTitle = $("#articleTitle").val();

	$.post("../scripts/encyclopedia.inc.php", 
		{ request: "add", title: articleTitle },
    	function(response) {
        if (response){
          alert(response);
        }
        console.log("article add sucess");
        location.reload();
    });
}

function addCharacter(){
	closeModal("addCharacterModal");

	var charName = $("#charName").val();

	$.post("../scripts/character.inc.php", 
		{ request: "add", name: charName },
    	function(response) {
        if (response){
          alert(response);
        }
        console.log("char add sucess");
    });
}

function openModal(modalID){
	var modal = document.getElementById(modalID);
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
        type: "POST",						                //request type
        data : {projectid: projid},				      //data to be sent to the server
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

    //Make current button "active" i.e. clicked on
    evt.currentTarget.className += " active";
  
    //Show tabcontent and subtab menu if applicable
    if(tabName == 'characters'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("encytab").style.display = "none";
      document.getElementById("chartab").style.display = "block"; //submenu
      document.getElementById(tabName).style.display = "block";   //tabcontent
    }
    else if(tabName == 'encyclopedia'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("chartab").style.display = "none";
      document.getElementById("encytab").style.display = "block";
      document.getElementById(tabName).style.display = "block";
    }
    else {
      document.getElementById("tabmenu").style.width = "30%";
      document.getElementById("chartab").style.display = "none";
      document.getElementById("encytab").style.display = "none";
      document.getElementById(tabName).style.display = "block";
    }  
    
    //Change default open tab
    $.post("../scripts/extrafunctions.inc.php", 
		  { request: "changeDefaultOpen", tab: tabName },
    	function(response) {
			  console.log("change default open sucess");
      });
}
  
  
  function openSubTab(evt, group, subTabName) {
    //hide other tab content
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    //deselect other buttons within the same sub menu e.g ctablinks
    tablinks = document.getElementsByClassName(group);
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    //now get the tab content and display it
    var subtabId = document.getElementById(subTabName);
    subtabId.style.display = "block";
    evt.currentTarget.className += " active";


    //Now send information to appropriate iframe
    $.ajax({
      url: "../scripts/extrafunctions.inc.php",
      type: "POST",	
      data : {request: "forIframe", group: group, id: subTabName},
      success: function(response){
        console.log("send info to iframe success" + response);
        switch(group){
          case 'ctablinks':
            break;
          case 'etablinks':
            subtabId.innerHTML = "<iframe src='../pages/encyclopedia.php'> </iframe>";
          default:
            break;
        }
      }			
    })
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

function updateArticle(id, field, event) {
  var newvalue = event.currentTarget.value;
  $.ajax({
      url: "../scripts/encyclopedia.inc.php",
      type: "POST",	
      data : {request: "edit", id:id, field: field, newvalue: newvalue},
      success: function(response){
        console.log("update artice success");
      }			
  })
}