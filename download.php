<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if (isset($_GET['filepath']) &&
    $_GET['filepath'] ) {
    $file = str_replace("\\/", '/', base64_decode($_GET['filepath']));
    if (is_file($file)) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename= " . basename($file));
        header("Content-Transfer-Encoding: binary");
        readfile($file);
    }
}
header("HTTP/1.1 500 Internal Server Error");

?>
