<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/10/2018
 * Time: 8:51 PM
 */


function downloadFromS3Cloud()
{
    include_once 'checkDownloadedFromS3.php';
    include_once 'S3.php';
    $s3Client = connectClient();
    $notDownloaded = checkDownloadedFromS3(true);
    $result = $s3Client->listBuckets(array());
    foreach ($result['Buckets'] as $bucketname) {
        $bucket = $bucketname['Name']; //presume there's only one bucket
    }

    foreach($notDownloaded as $key=> $download)
    {
        foreach($download[0] as $file)
        {
            if($file != '') {
                getdownloadFromS3Cloud($s3Client, $bucket, $key, $file);

            }
        }
    }

//        getDownloadFromS3Cloud($s3Client, $bucket, $key);

}

function getdownloadFromS3Cloud($s3Client, $bucket, $keyPrefix,$file)
{
    if (!file_exists($keyPrefix))
        mkdir($keyPrefix, 0777, true);

    $result = $s3Client->getObject(array(
        'Bucket' => $bucket,
        'Key'    => $keyPrefix.'/'.$file,
        'SaveAs' => $keyPrefix.'/'.$file
    ));
}

?>