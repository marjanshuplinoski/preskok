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

/**
 * get all Folders and Files
 */
function getFolderAndFilesPreview($Folders = null, $uploaded = null)
{
    if (!isset($Folders)) {
        $dirs = getFolderAsVar();

        echo '<div class="tree well">';
        foreach ($dirs as $key => $folder) {
            echo '<ul><li>';
            $scannedFolder = array_values(array_diff(scandir($folder), array("..", ".")));
            echo '<span><i class="icon-folder-open"></i>Local Folder: </span> <a href="">' . $folder . "</a>";

            foreach ($scannedFolder as $files) {
                echo '<ul><li><span><i class="icon-leaf"></i>File: </span><a href="">' . $files . "</a>";
                echo '</li></ul>';
            }
            echo '</li></ul>';
        }
        echo '</div>';
    } else if (isset($Folders) && !isset($uploaded)) {
        echo '<button id="uploadToS3Cloud">Click to Upload to S3 Cloud</button>';
        echo '<div class="tree well">';
        echo '<li class="parent_li"><span title="Collapse this branch"><i class="icon-folder-open icon-minus-sign"></i>Not Found Files in the S3 Cloud:</span> <a href=""></a></li>';
        foreach ($Folders as $key => $folder) {
            echo '<ul><li>';
            echo '<span><i class="icon-folder-open"></i>Local Folder: </span> <a href="">' . $key . "</a>";
            foreach ($folder[0] as $files) {
                if ($files != null) {
                    echo '<ul><li><span><i class="icon-leaf"></i>File: </span><a href="">' . $files . "</a>";
                    echo '</li></ul>';
                }
            }
            echo '</li></ul>';
        }
        echo '</div>';
    } else if (isset($Folders) && isset($uploaded)) {
        echo '<button id="downloadFromS3Cloud">Click to Download from S3 Cloud</button>';
        echo '<div class="tree well">';
        echo '<li class="parent_li"><span title="Collapse this branch"><i class="icon-folder-open icon-minus-sign"></i>Not Found Files in the local folders:</span> <a href=""></a></li>';
        foreach ($Folders as $key => $folder) {
            echo '<ul><li>';
            echo '<span><i class="icon-folder-open"></i>Local Folder: </span> <a href="">' . $key . "</a>";
            foreach ($folder[0] as $files) {
                if ($files != null) {
                    echo '<ul><li><span><i class="icon-leaf"></i>File: </span><a href="">' . $files . "</a>";
                    echo '</li></ul>';
                }
            }
            echo '</li></ul>';
        }
        echo '</div>';
    }
}

function getFolderAsVar()
{
    foreach ((glob("*")) as $key => $folder) {
        if (is_dir($folder) == true && preg_match('(aws-sdk-php|js|css|tmpUploadToS3Cloud|applied|SQLFiles|log)', $folder) === 0) {
            $dirs[$key] = $folder;
        }
    }
    $dirs = array_values($dirs);
    return $dirs;

}

function getFolderAndFilesAsVar()
{
    $folders = getFolderAsVar();
    $localFolders = array();
    foreach ($folders as $folder) {
        $localFolders[$folder] = array();
        $scannedFolder = array_values(array_diff(scandir($folder), array("..", ".")));
        foreach ($scannedFolder as $files) {
            array_push($localFolders[$folder], $files);
        }
    }
    return $localFolders;
}

?>