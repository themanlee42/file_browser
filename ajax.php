<?php
 require_once $_SERVER['DOCUMENT_ROOT']."/file_browser.php";

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
	
	if($_POST['path']){

		
		$fb = new fileBrowser ($_POST['path']);		
		$list = $fb->getList();
				
		echo json_encode($list);
	}
	
}
else{
	trigger_error('Access denied - not an AJAX request', E_USER_ERROR);
	exit;
}
?>