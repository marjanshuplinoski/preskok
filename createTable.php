<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/12/2018
 * Time: 8:49 PM
 */


function createTable()
{
    include_once 'db.php';
    include_once 'parserData.php';
    $columns = parserData(2);
    $data = parserData(21);
    $db = getDbConnection();
    $getTable = mysqli_query($db, "SHOW TABLES LIKE 'practical_data'");

    if (mysqli_num_rows($getTable) > 0) {
        //do nothing
    } else {

        $table = "CREATE TABLE practical_data (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        foreach ($columns as $key => $column) {
            $mysql_type = strpos($column, 'ID') !== false ? 'INT(11)' : (strpos($column, 'Date') !== false ? 'DATE' : 'VARCHAR(30)');
            $table .= "$column $mysql_type NOT NULL,";
        }
        $table = rtrim(trim($table), ',');
        $table .= ")";
        if ($db->query($table) === TRUE) {
            echo "Table practical_data created successfully";
        } else {
            echo "Error creating table practical_data: " . $db->error;
        }
    }

    $insert_into = implode(",", $columns);

    $thousand_queries = array();

    $hund_data = array_chunk($data, 100, true);

    $i = 0;

    foreach ($hund_data as $key => $multi_data) {
        $insert = "INSERT INTO practical_data ($insert_into) VALUES ";
        foreach ($multi_data as $key_single => $single_data) {
            $comma_separated = implode("','", $single_data);
            $comma_separated = "'" . $comma_separated . "'";
            array_push($thousand_queries, $comma_separated);
        }
        foreach ($thousand_queries as $t) {
            $insert .= "($t),";
        }
        $insert = rtrim(trim($insert), ',').';';
        if (!beginTransaction($insert, null, null, 22)) {
            break;
        } else {
            $thousand_queries = array();
//            echo "Inserted first {$key}000 records"; //depending you can add more zeros from chunk size
        }
    }

    $db->close();
}