<?php
session_start(); 
  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/ListRepository.php";

$db=getDbConn();
$listRepo = new ListRepository($db);



$id=$_REQUEST['id'];
 if(isset($id)):?>
<?php  $list = $listRepo->getListById($id);
   echo $list;
        if($list!=-1):?>
         <?php  $lists_items=$listRepo->getListItemsByListId($list['id']);
          ?> 
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
          <h2 id="list"><?php echo $list['name']?></h2>

  
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
          <?php if($lists_items!=-1):?>
                      
            
             <ul id="item">
           <?php foreach($lists_items as $item):?> 
            <li id='1' ><?php echo $item['name'];?></li>
               <?php endforeach?>
          </ul>          
            <?php endif?>
        </div>
          <?php endif?>
<?php endif?>
                                  <?php echo $id;?>

