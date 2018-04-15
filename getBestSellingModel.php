<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/15/2018
 * Time: 5:56 PM
 */

include_once 'parserData.php';


$data = parserData(21);

foreach ($data as $key => $value) {
    $BestSellingModel[$value['BuyerID']][$value['ModelID']] += 1;
    arsort($BestSellingModel[$value['BuyerID']]);
}

if (isset($argv[1]))
    if (isset($BestSellingModel[$argv[1]]))
        echo 'For BuyerID: ' . $argv[1] . ' best selling ModelID is: ' . implode(',',array_keys($BestSellingModel[$argv[1]], max($BestSellingModel[$argv[1]]))) . PHP_EOL;
    else
        echo 'Not Found that BuyerID' . $argv[1].PHP_EOL;
else
    foreach ($BestSellingModel as $key => $value) {
        echo 'For BuyerID: ' . $key . ' best selling ModelID is: ' . implode(',',array_keys($BestSellingModel[$key], max($BestSellingModel[$key]))) . PHP_EOL;
    }


?>