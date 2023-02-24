

<?php
require_once("Connect.php");

	$data =array();
	if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$stmt   = $con -> prepare('SELECT * FROM directory WHERE  (User_ID=?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetchAll();
	
		foreach( $items as $row) { 
 $arrayCategories[$row['ID']] = array("parent_id" => $row['Parent_id'], "name" =>                       
 $row['Name']);   
  }
//createTree($arrayCategories, 0);

 function createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1) {
 
foreach ($array as $categoryId => $category) {

if ($currentParent == $category['parent_id']) {                       

    if ($currLevel > $prevLevel) echo " <ol class='tree'> "; 

    if ($currLevel == $prevLevel) echo " </li> ";

    echo '<li> <label for="subfolder2">'.$category['name'].'</label> <input type="checkbox" id="subfolder2"/>';

    if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }

    $currLevel++; 

    createTree ($array, $categoryId, $currLevel, $prevLevel);

    $currLevel--;               
    }   

}

if ($currLevel == $prevLevel) echo " </li>  </ol> ";

}   
?>

