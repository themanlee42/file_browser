<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if (isset($_POST['path']) &&
    $_POST['path'] &&
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $fb = new fileBrowser ($_POST['path']);
    $list = $fb->getList();
    echo json_encode($list);
    header("HTTP/1.1 200 OK");
} else {
    header("HTTP/1.1 500 Internal Server Error");
}
?>