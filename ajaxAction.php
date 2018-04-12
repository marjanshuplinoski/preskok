<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/10/2018
 * Time: 10:11 AM
 */

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
        $action = $_POST["action"];
        switch ($action) { //Switch case for value of action
            //Basic
            //Script should get all files in directory (file names)
            case "getFolderAndFilesPreview":
                include_once 'getFolderAndFiles.php';
                getFolderAndFilesPreview();
                break;
            //Check that files in directory are uploaded onto AWS S3 * into bucket with same name as a folder, if not upload them
            case "checkUploadedToS3":
                include_once 'checkUploadedToS3.php';
                checkUploadedToS3();
                break;
            //bonus code: upload on click or auto upload both codes applied (just auto upload is commented)
            case "uploadToS3Cloud":
                include_once 'uploadToS3Cloud.php';
                uploadToS3Cloud();
                break;
            //Get all files on amazon (for provided folder) and check that all files are stored locally too, if not download them
            case "checkDownloadedFromS3":
                include_once 'checkDownloadedFromS3.php';
                checkDownloadedFromS3();
                break;
            //bonus code: download on click or auto download both codes applied (just auto download is commented)
            case "downloadFromS3Cloud":
                include_once 'downloadFromS3Cloud.php';
                downloadFromS3Cloud();
                break;
            //You have a directory with sql files, that are named like “change_20171023_j.sql”, “change_20171024_j.sql”, “change_20171029_j.sql. Write a script, that bundle files into one big sql file based on dates in names and run as SQL query on database. Move all files that were bundled into “applied/[YYYYMMDD]” folder. Script should return success if everything is ok and return exception with a message if error occurred. If error occurred in sql, make rollback
            case "SQLFiles":
                include_once 'SQLFiles.php';
                applySQLFiles();
                break;
            //Practical
            //Write a parser for provided data, so you get a valid associative array of all the rows
            case "parserData":
                include_once 'parserData.php';
                parserData();
                break;
            //
            case "createTable":
                include_once 'createTable.php';
                createTable();
                break;
        }
    }
}
//Function to check if the request is an AJAX request
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

?>