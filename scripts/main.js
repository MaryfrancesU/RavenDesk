function logo(){
  window.location.href = "../pages/dashboard.php";
}

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
  var articleTitle = $("#articleTitle").val();

  if(articleTitle == ""){
    alert("Please enter a title for your article.");
  }

  else{
    closeModal("addEncyclopediaModal");

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
}

function addCharacter(){
	var charName = $("#charName").val();
  
  if(charName == ""){
    alert("Please enter a name.");
  }

  else{
    closeModal("addCharacterModal");

    $.post("../scripts/character.inc.php", 
      { request: "add", name: charName },
        function(response) {
          if (response){
            alert(response);
          }
          console.log("char add sucess");
          location.reload();
    });
  }
}

function addBook(){
  var bookName = $("#bookName").val();

  if(bookName == ""){
    alert("Please enter a name.");
  }

  else{
	  closeModal("addBookModal");

    $.post("../scripts/plot.inc.php", 
      { request: "add", name: bookName },
        function(response) {
          if (response){
            alert(response);
          }
          console.log("book add sucess");
          location.reload();
      });
  }
}

function addPlotPoint(){
	var plotpoint = $("#ppta").val();

	$.post("../scripts/plot.inc.php", 
		{ request: "addpp", content: plotpoint },
    	function(response) {
        if (response){
          alert(response);
        }
        console.log("plot point add sucess");
        location.reload();
    });
}

function addLocation(){
	var locName = $("#locationName").val();

  if(locName == ""){
    alert("Please enter a name.");
  }

  else{
    closeModal("addLocationModal");

    $.post("../scripts/world.inc.php", 
      { request: "add", name: locName },
        function(response) {
          if (response){
            alert(response);
          }
          console.log("location add sucess");
          location.reload();
      });
  }
}

function openModal(modalID){
	var modal = document.getElementById(modalID);
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          closeModal(modalID);
        }
    }
}

function closeModal(modalID) {
    var modal = document.getElementById(modalID);
    modal.style.display = "none";

    if (modalID === "renameProjectModal"){
      location.reload();
    }

}

function deleteProj(projid){
    var items = document.getElementsByClassName("item");
    for (var i = 0; i < items.length; i++) {
      items.item(i).onclick = null;
    }
    var r = confirm("Do you really want to delete this project?");

    if (r == true) { 
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
    else {
      location.reload();
    }
}

function renameProj(projid){
  var items = document.getElementsByClassName("item");
  for (var i = 0; i < items.length; i++) {
    items.item(i).onclick = null;
  }
  openModal("renameProjectModal");

  //send projid to modal
  var hiddenInput = document.getElementById("renamePid");
  hiddenInput.value = projid;
}

function renameProj2(){
  var hiddenInput = document.getElementById("renamePid");
  var retrievedPID = hiddenInput.value;

  var userInput = document.getElementById("newProjectName");
  var newProjectName = userInput.value;

  $.ajax({
    url: "../scripts/extrafunctions.inc.php",	
    type: "POST",						                
    data : {request: "rename", projectid: retrievedPID, newname: newProjectName},
    success: function(response){  
        console.log("rename success");
        location.reload();
    }			
  })
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

    //Get all subtablinks and reset activeness
    subtablinks = document.getElementsByClassName("subtabbutton");
    for (i = 0; i < subtablinks.length; i++) {
      subtablinks[i].className = subtablinks[i].className.replace(" active", "");
    }

    //Make current button "active" i.e. clicked on
    evt.currentTarget.className += " active";
  
    //Show tabcontent and subtab menu if applicable
    if(tabName == 'plot'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("chartab").style.display = "none";
      document.getElementById("worldtab").style.display = "none";
      document.getElementById("encytab").style.display = "none";
      document.getElementById("plottab").style.display = "block"; //submenu
      document.getElementById(tabName).style.display = "block";   //tabcontent
    }
    else if(tabName == 'characters'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("plottab").style.display = "none";
      document.getElementById("worldtab").style.display = "none";
      document.getElementById("encytab").style.display = "none";
      document.getElementById("chartab").style.display = "block"; //submenu
      document.getElementById(tabName).style.display = "block";   //tabcontent
    }
    else if(tabName == 'world'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("plottab").style.display = "none";
      document.getElementById("chartab").style.display = "none";
      document.getElementById("encytab").style.display = "none";
      document.getElementById("worldtab").style.display = "block";
      document.getElementById(tabName).style.display = "block";
    }
    else if(tabName == 'encyclopedia'){
      document.getElementById("tabmenu").style.width = "15%";
      document.getElementById("plottab").style.display = "none";
      document.getElementById("chartab").style.display = "none";
      document.getElementById("worldtab").style.display = "none";
      document.getElementById("encytab").style.display = "block";
      document.getElementById(tabName).style.display = "block";
    }
    else { //for blurb
      document.getElementById("tabmenu").style.width = "30%";
      document.getElementById("plottab").style.display = "none";
      document.getElementById("chartab").style.display = "none";
      document.getElementById("worldtab").style.display = "none";
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
          case 'ptablinks':
            subtabId.innerHTML = "<iframe src='../pages/plot.php'> </iframe>";
            break;
          case 'ctablinks':
            subtabId.innerHTML = "<iframe src='../pages/character.php'> </iframe>";
            break;
          case 'wtablinks':
            subtabId.innerHTML = "<iframe src='../pages/world.php'> </iframe>";
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

function updateBook(id, field, event) {
  var newvalue = event.currentTarget.value;
  $.ajax({
      url: "../scripts/plot.inc.php",
      type: "POST",	
      data : {request: "edit", id:id, field: field, newvalue: newvalue},
      success: function(response){
        console.log("update book success");
      }			
  })
}

function updatePlotPoint(event) {
  var id = event.target.id;
  var newvalue = event.target.innerHTML;

  if (newvalue == ""){
    var conf = confirm("Do you really want to delete this plot point?\n"
                      + "If you select Cancel, you'll have a plot point with no text.");
  }

  if (conf == true) { //ie, yes delete
    $.ajax({
      url: "../scripts/plot.inc.php",
      type: "POST",	
      data : {request: "delete", id: id},
      success: function(response){
        console.log("delete plot point " + id + " success");
        location.reload();
      }			
    })
  }
  
  else {
    $.ajax({
        url: "../scripts/plot.inc.php",
        type: "POST",	
        data : {request: "edit", id: id, field: "pp", newvalue: newvalue},
        success: function(response){
          console.log("update plot point " + id + " success" + newvalue);
        }			
    })
  }
}

function updateCharacter(id, field, event) {
  var newvalue = event.currentTarget.value;
  $.ajax({
      url: "../scripts/character.inc.php",
      type: "POST",	
      data : {request: "edit", id:id, field: field, newvalue: newvalue},
      success: function(response){
        console.log("update char success");
      }			
  })
}

function updateLocation(id, field, event) {
  var newvalue = event.currentTarget.value;
  $.ajax({
      url: "../scripts/world.inc.php",
      type: "POST",	
      data : {request: "edit", id:id, field: field, newvalue: newvalue},
      success: function(response){
        console.log("update location success");
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
        console.log("update article success");
      }			
  })
}

function importChar(parameter){
  if (parameter == "dropdown1"){
    $(".hiddenCharDD").css("display", "none");
    var e = document.getElementById("imchar");
    var selectedId = e.value;
    var hi = "imchar"+selectedId;
    document.getElementById(hi).style.display = "block";
  }
  else if (parameter == "dropdown2"){
    document.getElementById("icb").style.display = "block";
  }

  else{
    var projid = document.getElementById("imchar").value;
    var charOption = document.getElementById("imchar"+projid);
    var charid = charOption.value;
    console.log("Imported character \t P: " + projid + ", C: " + charid);

    $.ajax({
      url: "../scripts/character.inc.php",
      type: "POST",	
      data : {request: "import", projid:projid, charid: charid },
      success: function(response){
        location.reload();
      }			
    })
  }
  
}



function deleteChar(id){
  var conf = confirm("Do you really want to delete this character?");

  if (conf == true) { 
    $.ajax({
        url: "../scripts/character.inc.php",
        type: "POST",
        data : {request: "delete", id: id},
        success: function(response){
            console.log("delete char success");
            parent.location.href=parent.location.href; 
        }			
    })
  }
}

function deleteLocation(id){
  var conf = confirm("Do you really want to delete this location?");

  if (conf == true) { 
    $.ajax({
        url: "../scripts/world.inc.php",
        type: "POST",
        data : {request: "delete", id: id},
        success: function(response){
            console.log("delete loc success");
            parent.location.href=parent.location.href; 
        }			
    })
  }
}

function deleteArticle(id){
  var conf = confirm("Do you really want to delete this article?");

  if (conf == true) { 
    $.ajax({
        url: "../scripts/encyclopedia.inc.php",
        type: "POST",
        data : {request: "delete", id: id},
        success: function(response){
            console.log("delete ency success");
            parent.location.href=parent.location.href; 
        }			
    })
  }
}