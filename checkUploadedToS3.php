<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/10/2018
 * Time: 10:13 AM
 */

include_once 'S3.php';

function checkUploadedToS3($uploadToS3Cloud = null)
{
    $s3Client = connectClient();
    $result = $s3Client->listBuckets(array());
    foreach ($result['Buckets'] as $bucketname) {
        $bucket = $bucketname['Name']; //presume there's only one bucket
    }

    $objects = $s3Client->listObjects([
        'Bucket' => $bucket,
        'Delimiter' => '/',
        'EncodingType' => 'url',
        'RequestPayer' => 'requester'
    ]);
    $s3PrefixesResult = $objects->get('CommonPrefixes');
    $s3FolderList = array();
    foreach ($s3PrefixesResult as $s3Prefixes) {
        $s3PrefixesObject = $s3Client->getIterator('ListObjects', array(
            'Bucket' => $bucket,
            'Prefix' => $s3Prefixes['Prefix']
        ));
        $filenames = array();
        foreach ($s3PrefixesObject as $file) {
            $file['Key'] = str_replace($s3Prefixes['Prefix'], "", $file['Key']);
            array_push($filenames, $file['Key']);
        }

        $s3Prefixes['Prefix'] = str_replace('/', '', $s3Prefixes['Prefix']);
        $s3FolderList[$s3Prefixes['Prefix']] = $filenames;
    }


    include_once 'getFolderAndFiles.php';
    $localFolders = getFolderAndFilesAsVar();


    $notFoundInS3CloudList = CompareLocalAndS3Folders($localFolders, $s3FolderList);
    if (!isset($uploadToS3Cloud))
        return getFolderAndFilesPreview($notFoundInS3CloudList);
    else
        return $notFoundInS3CloudList;
}


function CompareLocalAndS3Folders($localFolderList, $s3FolderList, $uploaded = null)
{
//show local not uploaded
//show s3 not downloaded
    if (!isset($uploaded)) {
        foreach ($localFolderList as $key => $s3Files) {
            $array[$key] = array();
            if (isset($s3FolderList[$key])) {
                array_push($array[$key], array_merge(array_diff($localFolderList[$key], $s3FolderList[$key])));
                unset($localFolderList[$key]);
            }
            else {
                array_push($array[$key], $localFolderList[$key]);
            }
        }
    } else {
        foreach ($s3FolderList as $key => $s3Files) {
            $array[$key] = array();
            if (isset($localFolderList[$key])) {
                array_push($array[$key], array_merge(array_diff($s3FolderList[$key], $localFolderList[$key])));
                unset($s3FolderList[$key]);
            } else
                array_push($array[$key], $s3FolderList[$key]);
        }

    }
    return $array;
}


?>