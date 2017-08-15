<?php

$path = $_GET["path"];
// open the file in a binary mode
$fp = fopen($path, 'rb');

header("Content-Type: " . mime_content_type($path));
header("Content-Length: " . filesize($path));

// dump the picture and stop the script
fpassthru($fp);
fclose($fp);
exit;