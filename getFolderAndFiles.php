<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/9/2018
 * Time: 7:18 PM
 */

//if necessary to generate random folder with files with text inside use include and generateFolderWithFiles();
//include_once "generate.php";

//generate folder with files
//generateFolderWithFiles();


if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
        $action = $_POST["action"];
        switch ($action) { //Switch case for value of action
            case "getFolderAndFiles":
                getFolderAndFiles();
                break;
        }
    }
}
//Function to check if the request is an AJAX request
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


/**
 * get all Folders and Files
 */
function getFolderAndFiles()
{
    foreach ((glob("*")) as $key => $folder) {
        if (is_dir($folder) == true && $folder != "aws-sdk-php" && $folder != "js") {
            $dirs1[$key] = $folder;
        }
    }

    $dirs = array_values($dirs1);
    foreach ($dirs as $key => $folder) {
        $scanned_folder = array_values(array_diff(scandir($folder), array("..", ".")));
        echo "Folder : " . $folder . "<br>";
        echo "contains the following files" . "<br>";
        foreach ($scanned_folder as $files) {
            echo "&ensp;&ensp;&ensp;file: " . $files . "<br>";
        }
        echo "<br>";

    }
}

?>