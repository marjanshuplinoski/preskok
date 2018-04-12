<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/10/2018
 * Time: 8:51 PM
 */


function uploadToS3Cloud()
{
    include_once 'checkUploadedToS3.php';
    include_once 'S3.php';
    $s3Client = connectClient();
    $notUploaded = checkUploadedToS3(true);
    $result = $s3Client->listBuckets(array());
    foreach ($result['Buckets'] as $bucketname) {
        $bucket = $bucketname['Name']; //presume there's only one bucket
    }

    //create tmp folder for all non-uploaded files to directly upload

    if (!file_exists('/tmp')) {
        mkdir('/tmp');
    }

    //clear any Temp files if were undeleted before
    clearTmp();
    foreach ($notUploaded as $key => $folder) {
        foreach ($folder[0] as $keyFile => $file) {
            // Create temp file
            if (!file_exists("tmpUploadToS3Cloud/$key")) {
                mkdir("tmpUploadToS3Cloud/$key", 0777, true);
            }
            $myfile = fopen("./" . tmpUploadToS3Cloud . "/$key/" . $file, "w") or die("Unable to open file!");
            $txt = file_get_contents($key . '/' . $file);
            fwrite($myfile, $txt);
            fclose($myfile);
        }
        uploadTmpDirectory($s3Client, $bucket, $key);
    }
}

function clearTmp()
{
    //clear all tmp files
    $folders = glob('tmpUploadToS3Cloud/*'); // get all file names
    foreach ($folders as $folder) { // iterate files
        if (is_dir($folder)) {
            $foldersInner = glob("$folder/*");
            foreach ($foldersInner as $file) {
                if (is_file($file))
                    unlink($file); // delete file
            }
        }

        rmdir($folder);
    }
}

function uploadTmpDirectory($s3Client, $bucket, $keyPrefix)
{
    $s3Client->uploadDirectory("./tmpUploadToS3Cloud/$keyPrefix", $bucket, $keyPrefix, array(
        'params' => array('ACL' => 'public-read'),
        'concurrency' => 20,
        'debug' => true
    ));
}

?>