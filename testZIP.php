<?php


///* Existing File name */
//$filePath = 'downloadedExtensionsTest/Volume-Master.crx';
//
///* New File name */
//$newFileName = 'downloadedExtensionsTest/Volume-Master-Converted.zip';
//
///* Rename File name */
//if( !rename($filePath, $newFileName) ) {
//    echo "File can't be renamed!";
//}
//else {
//    echo "File has been renamed!";
//}

//unzip file
$zip = new ZipArchive;
$res = $zip->open('downloadedExtensionsTest/Volume-Master-Converted.zip');

//Delete MACOSX created folder
if ($res === TRUE) {
    $zip->extractTo('downloadedExtensionsTest/Volume-Master-Converted/');
    $zip->close();
    $files = [
        'unziptest/_MACOSX'
    ];

    foreach ($files as $file) {
        if (file_exists($file)) {
            unlink($file);
        } else {
            echo "File not found";
        }
    }
    echo "yes and file deleted";
} else {
    echo "no";
}