<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/12/2018
 * Time: 1:08 PM
 */

function parserData($task = 1)
{

    $url = "https://admin.b2b-carmarket.com//test/project";
    $file_handle = fopen($url, "r");
    $columns = $unsortedData = $sortedData = array();;
    $i = 0;
    while (!feof($file_handle)) {
        $i++;
        $line = fgets($file_handle);
        if ($i == 1) {
            $columns = explode(',', trim(preg_replace('/\s+/', ' ', $line)));
        } else {
            $arrays = str_replace('<br>', '', trim(preg_replace('/\s+/', ' ', $line)));
            $unsortedData = explode(',', $arrays);

            array_push($sortedData, array_combine($columns, $unsortedData));
        }
    }
    fclose($file_handle);

    echo 'Get Data From ' . $url . '<br>';
    if ($task == 1) {
        echo 'Example of associate array';
        var_dump($sortedData);
    }
    if ($task == 2)
        return $columns;
    if ($task == 21)
        return $sortedData;
}

?>