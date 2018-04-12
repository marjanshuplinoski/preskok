<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/8/2018
 * Time: 12:20 PM
 */

//script for generating some random name
/**
 * Generate random string for folder or file names
 * @param null $length
 * @param int $chars
 * @return string
 */
function generateRandomString($length = null, $chars = 0)
{
    if ($length == null) {
        $length = rand(10, 25);
    }
    $characters = ($chars == 0) ? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' : '  abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Generate File random or specific number
 * @param null $number
 * @param $folder
 */
function generateFiles($number = null, $folder)
{
    $number = ($number == 0) ? rand(10, 20) : $number;
    for ($i = 0; $i < $number; $i++) {
        $file = generateRandomString();
        $text = generateRandomString(0, 1);
        $myfile = fopen("./" . $folder . "/" . $file . ".txt", "w") or die("Unable to open file!");
        $txt = $text . "\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}

/**
 * Generate folder with files
 */
function generateFolderWithFiles($filenumbers = 0)
{
    $folder = generateRandomString();

    if (file_exists ($folder)) {
        echo 'Folder exists: ' . $folder;
    } else {
        mkdir($folder, 0777, true);
        echo 'Created folder: ' . $folder;
    }


    generateFiles($filenumbers, $folder);
}

?>