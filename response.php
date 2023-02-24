
	<?php
	//include connection file 
require_once("Connect.php");

	$data =array();
	session_start();
$stmt   = $con -> prepare('SELECT * FROM directory WHERE  (User_ID=?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetchAll();
	
		foreach( $items as $row) { 
			$tmp = array();
			$tmp['ID'] = $row['ID'];
			$tmp['Name'] = $row['Name'];
			$tmp['text'] = $row['Name'];
			$tmp['parent_id'] = $row['Parent_id'];
			$tmp['href'] = 'http://google.com';
			array_push($data, $tmp); 
		}
		$itemsByReference = array();

	// Build array of item references:
	foreach($data as $key => &$item) {
	   $itemsByReference[$item['ID']] = &$item;
	   // Children array:
	   $itemsByReference[$item['ID']]['nodes'] = array();
	}

	// Set items as children of the relevant parent item.
	foreach($data as $key => &$item)  {
	//echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
	   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
	      $itemsByReference [$item['parent_id']]['nodes'][] = &$item;
		}
	}
	// Remove items that were added to parents elsewhere:
	foreach($data as $key => &$item) {
		 if(empty($item['nodes'])) {
			unset($item['nodes']);
			}
	   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
	      unset($data[$key]);
		 }
	}

	// Encode:
	echo json_encode($data);
	?>
