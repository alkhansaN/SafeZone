
<!-- https://github.com/phpflow/bootstrap_treeview_menu_example_using_php_mysql -->
<!DOCTYPE html>

<php lang="en">
<head>
  <meta charset="UTF-8">
  <title>Safe zone </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style/style.css">


</head>
<body onclick="myFunction_2(event)">
  <div id="context-menu">
      <div class="item" id="UploadFile">Upload File</div>
     
    </div>
<!-- partial:index.partial.html -->
<div class="header">
  <div class="popup">
        <button id="close">&times;</button>
        <h2>Add Folder</h2>
        

           <div class="inputs">
			<form action="DataBase\AddFolder.php" method="post">
				<input type="text" class="input" name='FName' placeholder="name">
				
		
<br>
		
		<input type="submit" value="Save"  class="SubmitButton"/>
		</form>

      
       </div>
    </div>
<div  id="popup2">
        <button id="close2">&times;</button>
<?php include("UplLoadFilePage.php");?>
          
    </div>

<div  id="popup3" style="position: fixed;">
        <button id="close3">&times;</button>
 <h2>Share file </h2>
        

           <div class="inputs">
			<form action="DataBase\share.php" method="post">
                                <input type="hidden" class="input" name='file_ID' id="file_ID" placeholder="file ID">
<select id="country" placeholder="type to search" name="SUser_id" style="
    width: 50%;
    height: 40px;
">
<?php

require_once("DataBase/Connect.php"); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$stmt   = $con -> prepare('SELECT * FROM users WHERE  (User_ID<>?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetchAll();
?>
	  
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
               foreach( $items as $rows)
                {
            ?>
  <option  value=<?php echo $rows['User_ID'];?> hidden><?php echo $rows['User_Email'];?></option>
 <?php } ?>
</select>
				
		
<br><br><br>
<div style="display: flex;height: 20px;">
		<input type="radio" name="ShareType"  value="1" />View
                <input type="radio" name="ShareType"  value="2" />Download
                <input type="radio" name="ShareType"  value="3" />View and Download
</div>
<br><br><br>
<div style="height: 20px;">
<input type="checkBox" name="WithPassword"  value="1" />Share with Password 
<input type="checkBox" name="WithSig"  value="1" /> Share with signature 

		  <input type="Password" class="input" name='Password' id="file_ID" placeholder="Enter Password" style="height: fit-content;">
</div>
<br><br><br>
		<input type="submit" value="Share"  class="SubmitButton" />
		</form>

      
       </div>
          
    </div>
<?php

require_once("DataBase/Connect.php"); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$stmt   = $con -> prepare('SELECT User_image FROM users  WHERE  (User_ID=?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetch();


echo '<a href="profile.php"> <img src="data:image/jpeg;base64,'. base64_encode($items['User_image']).'"></a>';
?>
<input type="text"   placeholder="Search">
</div>
<div id="menubar">

  <ul>
      <li><button id="SubmitButton" class="SubmitButton" style="float: left;">+Add Folder </button></li>    
  </ul>
  </div>

<div class="box-form" style="
    width: 100%;border-radius: 0px;    margin: 0px;height: 2000px;
">
	<div class="left" style="width: 30%;">
		<div class="overlay" style="display: -webkit-inline-box;color: black;">
<!--  www.php.net  !-->

<?php 
require_once("DataBase/tree.php");?>
<div id="content" class="general-style1">
<?php 
echo "<ol class='tree' id='tree'><li>
			<label style='background: url(images/folder-horizontal.png) 15px 1px no-repeat;' for='folder2'>my files</label> <input type='checkbox' id='folder2' />"; 
	
createTree($arrayCategories, 0); echo "</li></ol>";?>
<br>
<div  style='background: url(images/user.png) 15px 1px no-repeat; font-size:large; font-size: large;
    padding: 0px 50px;cursor: pointer;
    height: 40px;margin-left: 45px;'><h2 style="font-size: small;"  id="ShareButton">
 <a  href="sharefile.php" > Shared with me</a>
 </h2> </div>

<br>
<div  style='background: url(images/trash.png) 15px 1px no-repeat; font-size:large; font-size: large;
    padding: 0px 50px;cursor: pointer;
    height: 40px;margin-left: 45px;'><h2 style="font-size: small;"  id="ShareButton">
 <a  href="Trash.php" >recycle</a>
 </h2> </div>

<?php
$size=0;
require_once("DataBase/Connect.php"); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$stmt   = $con -> prepare('SELECT * FROM user_upload WHERE  (User_ID=?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetchAll();
?>
	  
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
               foreach( $items as $rows)
                {
try{
$size=$size+filesize("DataBase/uploads/".$rows['FileName']);
 }
catch(PDOException $e) {

}

}
            ?>
<div class="progress-container" style="    margin-left: 60px;">
  <progress value=<?php echo( $size/1000000000/100)*7 ;?> max="100"><?php echo $size/1000000000 ;?>%</progress>

<h3 style="font-size: x-small;"><?php  echo $size/1000000000  ."  GB from  7 GB";?> </h3>
</div>
</div>
	
		</div>
	</div>
	
	
	<div class="right">
<?php

require_once("DataBase/Connect.php"); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$stmt   = $con -> prepare('SELECT * FROM user_upload WHERE  (User_ID=?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetchAll();
?>
	  
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
               foreach( $items as $rows)
                {

            ?>
             <div  class="context-menu" id="<?php echo 'context-menu'.$rows['ID'];?>">
          <div class="item"><a  href="DataBase/uploads/<?php echo $rows['FileName']; ?>" download> Download file </a></div>
      <div class="item" onclick="myFunction(<?php echo $rows['ID'];?>)">Share</div>
      <div class="item"><a <a onclick='deletefile(<?php echo  $rows['ID'] ?>)'>remove</a> </div>
    </div>
           <div class="overlay" id=<?php echo $rows['ID'];?> style="display: inline-block;color: black;margin:5px; border: #F0F6F9;border-block-width: 3px;border-style: solid;">     
           <img   src="images/newFolder.png" width="200px" style="padding:10px 30px;"> 

           <h3 style="margin-left: 5px;width:250px; "><?php echo $rows['FileName'];?></h3> </div>    
         

<script type="text/javascript">
      const contextMenu<?php echo $rows['ID'];?> = document.getElementById("<?php echo 'context-menu'.$rows['ID'];?>");
      const  scope<?php echo $rows['ID'];?> = document.getElementById(<?php echo $rows['ID'];?>);

      const normalizePozition<?php echo $rows['ID'];?> = (mouseX, mouseY) => {
        // ? compute what is the mouse position relative to the container element (scope)
        let {
          left: scopeOffsetX,
          top: scopeOffsetY,
        } = scope<?php echo $rows['ID'];?>.getBoundingClientRect();
        
        scopeOffsetX = scopeOffsetX < 0 ? 0 : scopeOffsetX;
        scopeOffsetY = scopeOffsetY < 0 ? 0 : scopeOffsetY;
       
        const scopeX<?php echo $rows['ID'];?> = mouseX - scopeOffsetX;
        const scopeY<?php echo $rows['ID'];?> = mouseY - scopeOffsetY;

        // ? check if the element will go out of bounds
        const outOfBoundsOnX<?php echo $rows['ID'];?> =
          scopeX<?php echo $rows['ID'];?> + contextMenu<?php echo $rows['ID'];?>.clientWidth > scope<?php echo $rows['ID'];?>.clientWidth;

        const outOfBoundsOnY<?php echo $rows['ID'];?> =
          scopeY<?php echo $rows['ID'];?> + contextMenu<?php echo $rows['ID'];?>.clientHeight > scope<?php echo $rows['ID'];?>.clientHeight;

        let normalizedX = mouseX;
        let normalizedY = mouseY;

        // ? normalize on X
        if (outOfBoundsOnX<?php echo $rows['ID'];?>) {
          normalizedX =
            scopeOffsetX + scope<?php echo $rows['ID'];?>.clientWidth - contextMenu<?php echo $rows['ID'];?>.clientWidth;
        }

        // ? normalize on Y
        if (outOfBoundsOnY<?php echo $rows['ID'];?>) {
          normalizedY =
            scopeOffsetY + scope<?php echo $rows['ID'];?>.clientHeight - contextMenu<?php echo $rows['ID'];?>.clientHeight;
        }

        return { normalizedX, normalizedY };
      };

      scope<?php echo $rows['ID'];?>.addEventListener("contextmenu", (event) => {
        event.preventDefault();

        const { clientX: mouseX, clientY: mouseY } = event;

        const { normalizedX, normalizedY } = normalizePozition<?php echo $rows['ID'];?>(mouseX, mouseY);

        contextMenu<?php echo $rows['ID'];?>.classList.remove("visible");

        contextMenu<?php echo $rows['ID'];?>.style.top = `${normalizedY}px`;
        contextMenu<?php echo $rows['ID'];?>.style.left = `${normalizedX}px`;

        setTimeout(() => {
          contextMenu<?php echo $rows['ID'];?>.classList.add("visible");
        });
      });
 var scope_2 = document.querySelector("body");
      scope_2.addEventListener("click", (e) => {
        // ? close the menu if the user clicks outside of it
        if (e.target.offsetParent != contextMenu<?php echo $rows['ID'];?>) {
          contextMenu<?php echo $rows['ID'];?>.classList.remove("visible");
        }
      });
    </script>
            <?php
                }
            ?>
       
    	
	</div>
	
</div>

<!-- partial -->
     <!--Script-->
    <script type="text/javascript">
document.querySelector("#SubmitButton").addEventListener("click", function(){
            document.querySelector(".popup").style.display = "block";
});


document.querySelector("#close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
});
    </script> 


 <script type="text/javascript">


document.querySelector("#UploadFile").addEventListener("click", function(){
            document.querySelector("#popup2").style.display = "block";
});


document.querySelector("#close2").addEventListener("click", function(){
    document.querySelector("#popup2").style.display = "none";
});
    </script> 


 <script type="text/javascript">
var topX=0;
function myFunction_2(event) {
 topX=event.offsetY;
}
function myFunction(fileid) {
var normalizedY=topX;

 

document.getElementById("file_ID").value = fileid;
document.querySelector("#popup3").style.display = "block";
}

document.querySelector("#close3").addEventListener("click", function(){
    document.querySelector("#popup3").style.display = "none";
});
    </script> 

<script>
function deletefile(file_id) {
if (confirm("Are you sure you want to delete file"))  {

var data = {
        file_id:file_id,
    };

    var xhr = new XMLHttpRequest();

    //👇 set the PHP page you want to send data to
    xhr.open("Post", "DataBase/delet_image.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    //👇 what to do when you receive a response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
location.reload();
        }
    };

    //👇 send the data
    xhr.send(JSON.stringify(data));

}
}
</script>

<script>
      const contextMenu = document.getElementById("context-menu");
      const scope_250 = document.getElementById("tree");

      const normalizePozition = (mouseX, mouseY) => {
        // ? compute what is the mouse position relative to the container element (scope)
        let {
          left: scopeOffsetX,
          top: scopeOffsetY,
        } = scope_250.getBoundingClientRect();
        
        scopeOffsetX = scopeOffsetX < 0 ? 0 : scopeOffsetX;
        scopeOffsetY = scopeOffsetY < 0 ? 0 : scopeOffsetY;
       
        const scopeX = mouseX - scopeOffsetX;
        const scopeY = mouseY - scopeOffsetY;

        // ? check if the element will go out of bounds
        const outOfBoundsOnX =
          scopeX + contextMenu.clientWidth > scope_250.clientWidth;

        const outOfBoundsOnY =
          scopeY + contextMenu.clientHeight > scope_250.clientHeight;

        let normalizedX = mouseX;
        let normalizedY = mouseY;

        // ? normalize on X
        if (outOfBoundsOnX) {
          normalizedX =
            scopeOffsetX + scope_250- contextMenu.clientWidth;
        }

        // ? normalize on Y
        if (outOfBoundsOnY) {
          normalizedY =
            scopeOffsetY + scope_250- contextMenu.clientHeight;
        }

        return { normalizedX, normalizedY };
      };

      scope_250.addEventListener("contextmenu", (event) => {
        event.preventDefault();

        const { clientX: mouseX, clientY: mouseY } = event;

        const { normalizedX, normalizedY } = normalizePozition(mouseX, mouseY);

        contextMenu.classList.remove("visible");

        contextMenu.style.top = `${normalizedY}px`;
        contextMenu.style.left = `${normalizedX}px`;

        setTimeout(() => {
          contextMenu.classList.add("visible");
        });
      });
 const scope_200 = document.querySelector("body");
      scope_200.addEventListener("click", (e) => {
        // ? close the menu if the user clicks outside of it
        if (e.target.offsetParent != contextMenu) {
          contextMenu.classList.remove("visible");
        }
      });
    </script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets_1/js/script.js"></script>
<script>
 $(function(){
  $("#country").select2();
 }); 
</script>
</body>
</html>
