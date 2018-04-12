<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/9/2018
 * Time: 7:31 PM
 */


require 'aws-sdk-php/vendor/autoload.php';
use Aws\S3\S3Client;

function connectClient()
{
    $s3Client = new S3Client([
        'version' => 'latest',
        'region' => 'eu-central-1',
        'credentials' => [
            'key' => 'AKIAJ6JL7VSKC3YPO6ZA',
            'secret' => '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',
        ],
    ]);
    return $s3Client;
}


?>