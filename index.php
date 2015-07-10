<?php
//xdebug needed
//xdebug_start_code_coverage();

require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/file_browser.php";

$fb = new fileBrowser ($CONFIG['default_dir']);

$default_list = $fb->getList();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
 
<title>File Browser</title>
<meta name="description" content="Simple Ajax File Browser" />
<meta name="keywords"
	content="file browser, tree directory, ajax file view" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="/assets/css/file_browser.css">

</head>

<body>
<div class="container">
	<div id="titleBar">Ajax File Browser : <?php echo $CONFIG['default_dir'];?></div>

	<div class="file-browser">
	
		<ul>
		<?php foreach($default_list as $file):?>		
		<li action="" data_ref="<?php echo realpath($file['full'])?>" class="<?php echo $file['type'] == 'D' ? 'folder' : 'file'?>"><a href="#"><?php echo $file['base']?></a></li>		
		<?php endforeach;?>				
		</ul>
		
	</div>
</div>
	
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>	
	<script
		src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<script src="/assets/js/file_browser.js"></script>
		
</body>
</html>
<?php 
//xdebug needed
//var_dump(xdebug_get_code_coverage());
?>