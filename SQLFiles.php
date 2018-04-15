<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/11/2018
 * Time: 10:17 AM
 */

function applySQLFiles()
{
    include_once 'db.php';
    $db = getDbConnection();
    generateTable($db);
    $sqlDirectory = 'SQLFiles';
    $scannedFolder = array_values(array_diff(scandir($sqlDirectory), array("..", ".")));


    makeBiggerSqlFile($scannedFolder);
    $sqlSource = 'SQLFiles/BiggerSQL.sql';

    $sql_query = @fread(@fopen($sqlSource, 'r'), @filesize($sqlSource)) or die('problem ');
    $sql_query = remove_remarks($sql_query);
    $queries = split_sql_file($sql_query, ';');


    beginTransaction($queries, $sqlDirectory, $scannedFolder);

    $db->close();
}

function makeBiggerSqlFile($SqlFiles)
{
    //sort by date

    foreach ($SqlFiles as $files) {
        if (explode("_", $files)[0] == 'change') {
            $date = explode("_", $files)[1];

            if (checkIsAValidDate($date)) {
                $sortedFiles[$date] = array();
                array_push($sortedFiles[$date], $files);
            }
        }
    }
    if (isset($sortedFiles)) {
        //sort by date
        ksort($sortedFiles, SORT_NUMERIC);
        $myfile = fopen("./SQLFiles" . "/BiggerSQL" . ".sql", "w") or die("Unable to open file!");
        $txt = '';
        foreach ($sortedFiles as $key => $sql) {
            $txt .= '-- date: ' . $key . PHP_EOL;
            $txt .= getContentSQL($sql[0]);
            $txt .= PHP_EOL;
        }
        fwrite($myfile, $txt);
        fclose($myfile);
    } else {
        echo 'No SQL Files found in folder /SQLFiles';
        die;
    }
}

function checkIsAValidDate($myDateString)
{
    return (bool)strtotime($myDateString);
}

function getContentSQL($file)
{
    return file_get_contents('./SQLFiles/' . $file);
}

function generateTable($conn)
{
    $con = $conn;
    $getTable = mysqli_query($conn, "SHOW TABLES LIKE 'sqlfiles'");

    if (mysqli_num_rows($getTable) > 0) {
        //do nothing
    } else {
        //create table
        $table = "   -- ------------------------------------------------------------------
                    --
                    -- Table structure for table `sqlfiles`
                    --
                    CREATE TABLE `sqlfiles` (
                      `id` int(11) NOT NULL,
                      `name` varchar(255) DEFAULT NULL,
                      `lastname` varchar(255) DEFAULT NULL,
                      `city` varchar(255) DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                    --
                    -- Indexes for table `sqlfiles`
                    --
                    ALTER TABLE `sqlfiles`
                      ADD KEY `id` (`id`);
                    --
                    -- AUTO_INCREMENT for table `sqlfiles`
                    --
                    ALTER TABLE `sqlfiles`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
                    -- ------------------------------------------------------------------";
        mysqli_multi_query($conn, $table);
        mysqli_commit($conn);
    }
}


function appliedToDir($sqlDir, $scanned)
{
    $date = date("Ymd");
    if (file_exists ("applied/$date")) {
        echo 'Folder exists: ' . "applied/$date";
    } else {
        mkdir("applied/$date", 0777, true);
        echo 'Created folder: ' . "applied/$date";
    }
    foreach ($scanned as $dir) {
        if (explode("_", $dir)[0] == 'change') {
            $targetpath ="$sqlDir/$dir";
            $backuppath = "applied/$date/$dir";

                // try with copy and delete
                if (!copy($targetpath, $backuppath))
                    die("9\nCould not move existing file to backup");
                touch($backuppath, filemtime($targetpath));
                if (!unlink($targetpath))
                    die("9\nCould not move existing file to backup");

        }
    }
    print_r(error_get_last());

}

?>