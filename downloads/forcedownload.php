<?php
/* Lara Maia <dev@lara.click> 2016 */

$root = $_SERVER['DOCUMENT_ROOT'];
$filepath = preg_replace('#/+#', '/', $root.'/'.$_GET['filename']);

if($_GET['debug'] == "1") {
    print("root: ".$root."<br/>\n");
    print("filename: ".$_GET['filename']."<br/>\n");
    print("filepath: ".$filepath."<br/>\n");
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$_GET['filename']);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));

    $fh = gzopen($filepath, "r");
    echo gzread($fh, filesize($filepath));
    ob_flush();
    flush();
}
