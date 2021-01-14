<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

$default_list = [];
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //don't really need COM class for acquiring drives
    foreach (range('A', 'Z') as $char) {
        if (@disk_total_space($char.":")) {
            $default_list[$char]['type'] = fileBrowser::FB_DIRECTORY;
            $default_list[$char]['base'] = $char.":";
            $default_list[$char]['full'] = $char.":";
        }
    }
}
else {
    //haven't tested for other OS
    $default_list[0]['type'] = fileBrowser::FB_DIRECTORY;
    $default_list[0]['base'] = "/";
    $default_list[0]['full'] = "/";
}

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>File Browser</title>
        <meta name="description" content="Simple Ajax File Browser"/>
        <meta name="keywords"
              content="file browser, tree directory, ajax file view"/>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="/assets/css/file_browser.css">

    </head>

    <body>
    <div class="container">
        <div id="titleBar">Ajax File Browser By Jason Lee (https://github.com/themanlee42)
            <br/><br/>
            <p class="currentDir"></p>
        </div>

        <div class="file-browser">
            <ul>
                <?php foreach ($default_list as $file): ?>
                    <li action="" data_ref="<?php echo realpath($file['full']) ?>"
                        class="drive"><a
                                href="#"><?php echo $file['base'] ?></a></li>
                <?php endforeach; ?>
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