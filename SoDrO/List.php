<?php
  session_start();

  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/UserRepository.php";
  require_once __DIR__. "/ListRepository.php";


  $db=getDbConn();
  $userRepo = new UserRepository($db);
  $listRepo = new ListRepository($db);
  if($_SESSION['token']!="none")
    $user = $userRepo->getUserFromToken($_SESSION['token']);
  else{
      header("Location: SignIn.php");
      exit;
  }
    
if($_SERVER['REQUEST_METHOD']==='POST'){
  $listRepo->addList($user->id,$_POST['listName']);
}

try {
    if(isset($user)){
      $lists=$listRepo->getUserListsByUserId($user->id);
    }
  } catch (Exception $e) {
    echo $e->getMessage();
}
?>
<script>
  function showItems(id) {
      var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
console.log(this.responseText);
        document.getElementById('listCont').innerHTML=this.responseText;
      }
    }
xml.open("GET", "ListItems.php?id="+id, true);
xml.send();
  }
</script>
<!DOCTYPE html>
<html lang="en">
  <head> 
    <title>SoDrO - Lists </title>
      <link href="ListStyle.css" rel="stylesheet" type="text/css">
      <link href="Style.css" rel="stylesheet" type="text/css">
      <link href="BannerStyle.css" rel="stylesheet" type="text/css">
      <link href="SignInStyle.css" rel="stylesheet" type="text/css">
  </head>
  <body>   
    <?php include_once('Banner.php'); ?>
    <div class='titleBar1' style="height:70px;"><br><h2>My Lists</h2></div>
    <div class="row">
        <?php if($lists!=-1):?>
      <div class='listOfTitlesCont'>
        <div class="row">
          <h2 id="lists">Lists</h2>
          <button id="addListBtn" class="listManagerBtn" type="button">
            <img src="Buttons/add.png" class="addBt">
          </button>  
          <div class="popup" id="popupAddList">
            <div class="popup-content" style="background:#ffc268;">
              <p>Give your list a title: </p>
               <form action= "<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <label for="listName"></label><br>
                <input type="text" class="formularBar" id="listName" name="listName" placeholder="List Title" maxlength="20" required><br>
                <br>
                <input type="submit" class="Submit" value="Create">
              </form><br><br><br>
            </div>
          </div>
        </div> 
        <div class="listsBody">
          <?php foreach ($lists as $list) :?>
            <button class="listTitleButton" type="button" onclick="showItems(<?php echo $list['id'];?>)"> <?php echo $list['name']?> </button>
          <?php endforeach ?>

        </div> 
      </div> <!-- Left Container end -->
      <?php else:?>
       <div class='listOfTitlesCont' id="noLists">
        <div class="row">
          <h2 id="lists">Lists</h2>
          <button id="addListBtn" class="listManagerBtn" type="button">
            <img src="Buttons/add.png" class="addBt">
          </button>
          <div class="popup" id="popupAddList">
            <div class="popup-content" style="background:#ffc268;">
              <p>Give your list a title: </p>
               <form action= "<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <label for="listName"></label><br>
                <input type="text" class="formularBar" id="listName" name="listName" placeholder="List Title" maxlength="20" required><br>
                <br>
                <input type="submit" class="Submit" value="Create">
              </form><br><br><br>
            </div>
          </div>
        </div>
        <div class="listsBody">
        </div> 
      </div> <!-- Left Container end -->
      <?php endif?>
      <?php if($lists!=-1):?>
      <div class='listCont' id='listCont'>
        <div class="row">
          <button id="deleteListBtn" class="listManagerBtn" type="button" >
              <img src="Buttons/bin.png" class="binBt">
          </button>
          <div class="popup" id="popupDelList">
                <div class="popup-content">
                  <p>The list will be deleted permanently, are You sure about that?</p>
                  <div class="row">
                    <button id="yes" class="decisionBtn" type="button">
                      <p2>Yes</p2>
                    </button>
                    <button id="no" class="decisionBtn" type="button">
                      <p2>No</p2>
                    </button>
                  </div>
                </div>
          </div>
          <h2 id="list"><?php echo $lists[0]['name']?></h2>

  
          <!-- Aici e butonul de add users !!!!! -->
          <button id="addUsersBtn" class="addUsersBtn" type="button" >
              Add Users
          </button>
          <div class="popup" id="popupAddUsersToList">
            <div class="popup-content" style="background:#ffc268;">
              <p>Add users to your list: </p>
               <form action= "<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <label for="usersName"></label><br>
                <input type="text" class="formularBar" id="usersName" name="usersName" placeholder="User name" maxlength="20" required><br>
                <br>
                <input type="submit" class="Submit" value="Add">
              </form><br><br><br>
            </div>
          </div>
        </div>
        <div class="listBody" id="listBody">
  
          <ul id="item">
            <li id='1'>Hit the gym</li>
            <li class="checked" id='1'>Pay bills</li>
            <li id='1'>Meet George</li>
            <li id='1'>Buy eggs</li>
            <li id='1'>Read a book</li>
            <li id='1'>Organize office</li>
             <li id='1'>Organize office</li>
             <li id='1'>Organize office</li>
             <li id='1'>Organize office</li>
             <li id='1'>Organize office</li>
             <li id='1'>Organize office</li>
          </ul>
        </div>

      </div> <!-- Right Container End -->
       <?php endif?>
    </div>

    
  <script>     
    <?php if($lists!=-1):?>
      var popupAddListWindow = document.getElementById("popupAddList");
      var popupAddUsersToListWindow = document.getElementById("popupAddUsersToList");

      var popupDelListWindow = document.getElementById("popupDelList");

      
      // Get the button that opens the popup for create new List
      var addListBtn = document.getElementById("addListBtn");

      var addUsersBtn = document.getElementById("addUsersBtn");

       // Get the button that opens the popup for delete
      var deleteListBtn = document.getElementById("deleteListBtn");
      
      // Get the <span> element that closes the popup
      
       var no =  document.getElementById("no");
       var yes =  document.getElementById("yes");
       no.onclick = function() {
          popupDelListWindow.style.display = "none";
      }
      yes.onclick = function() {
          popupDelListWindow.style.display = "none";    
      }
      
      // When the user clicks the button, open the popup 
      addListBtn.onclick = function() {
        popupAddListWindow.style.display = "block";
      }
     
       deleteListBtn.onclick = function() {
        popupDelListWindow.style.display = "block";
      }

      addUsersBtn.onclick = function() {
        popupAddUsersToListWindow.style.display = "block";
      }
      
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == popupAddListWindow) {
          popupAddListWindow.style.display = "none";
        }
        else if (event.target == popupDelListWindow) {
          popupDelListWindow.style.display = "none";
        }
        else if (event.target == popupAddUsersToListWindow) {
          popupAddUsersToListWindow.style.display = "none";
        }
      }
      <?php else :?>
        var popupAddListWindow = document.getElementById("popupAddList");
        
        // Get the button that opens the popup for create new List
        var addListBtn = document.getElementById("addListBtn");
        
        // When the user clicks the button, open the popup 
        addListBtn.onclick = function() {
          popupAddListWindow.style.display = "block";
        }
       
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == popupAddListWindow) {
            popupAddListWindow.style.display = "none";
          }
        }
      <?php endif ?>
  
  </script>
    
    <script>
    // Create a "close" button and append it to each list item
    var myNodelist = document.getElementsByTagName("LI");
    var i;
    for (i = 0; i < myNodelist.length; i++) {
      if(myNodelist[i].id=="1"){
var span = document.createElement("SPAN");
      var txt = document.createTextNode("\u00D7");
      span.className = "close";
      span.appendChild(txt);
      myNodelist[i].appendChild(span);
      }
    }
    
    // Click on a close button to hide the current list item
    var close = document.getElementsByClassName("close");
    var i;
    for (i = 0; i < close.length; i++) {
      close[i].onclick = function() {
        var div = this.parentElement;
        div.style.display = "none";
      }
    }
    
    // Add a "checked" symbol when clicking on a list item
    var listCheck = document.querySelector('ul#item');
    listCheck.addEventListener('click', function(ev) {
      if (ev.target.tagName === 'LI' && ev.target.id=='1') {
        ev.target.classList.toggle('checked');
      }
    }, false);
    
    
    </script>
  </body>
</html>