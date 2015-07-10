<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/file_browser.php";

echo "<PRE>";
$test = new fileBrowser ($_SERVER['DOCUMENT_ROOT']);
echo "CURRENT DIR:";
print_r ( $test->getDirectory () );
echo "<br>";
print_r ( $test->getFiles () );
echo "<br>";
print_r ( $test->getList () );
echo "<br>";
if($test->scanDir ( "C:/project/web/clout_test/directory/folder1" )){
	echo "CURRENT DIR:";
	print_r ( $test->getDirectory () );
	echo "<br>";
	print_r ( $test->getFiles () );
	echo "<br>";
	print_r ( $test->getList () );
	echo "<br>";
}
else{
	echo "file:".$test->getDirectory ();;
	echo "<br>";
}
if($test->scanDir ( "C:/project/web/clout_test/directory/file1.txt" )){
	echo "CURRENT DIR:";
	print_r ( $test->getDirectory () );
	echo "<br>";
	print_r ( $test->getFiles () );
	echo "<br>";
	print_r ( $test->getList () );
	echo "<br>";
}
else{
	echo "file:".$test->getDirectory ();
	echo "<br>";
}

if($test->scanDir ( "C:/project/web/clout_test/directory/.." )){
	echo "CURRENT DIR:";
	print_r ( $test->getDirectory () );
	echo "<br>";
	print_r ( $test->getFiles () );
	echo "<br>";
	print_r ( $test->getList () );
	echo "<br>";
}
else{
	echo "file:".$test->getDirectory ();
	echo "<br>";
}


if($test->scanDir ( "C://Windows" )){
	echo "CURRENT DIR:";
	print_r ( $test->getDirectory () );
	echo "<br>";
	print_r ( $test->getFiles () );
	echo "<br>";
	print_r ( $test->getList () );
	echo "<br>";
}
else{
	echo "file:".$test->getDirectory ();
	echo "<br>";
}

echo "</PRE>";

//expects error
if($test->scanDir ( "D://Windows" )){
	echo "CURRENT DIR:";
	print_r ( $test->getDirectory () );
	echo "<br>";
	print_r ( $test->getFiles () );
	echo "<br>";
	print_r ( $test->getList () );
	echo "<br>";
}
else{
	echo "file:".$test->getDirectory ();
	echo "<br>";
}

echo "</PRE>";
?>