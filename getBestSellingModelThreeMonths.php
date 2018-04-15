<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/15/2018
 * Time: 5:56 PM
 */

include_once 'parserData.php';


$data = parserData(21);
$options = getopt("e:s:");  //e - enddate s-specific date

if (!isset($options['e'])) {
    echo 'Please use -e YYYY-MM-DD format date to check last 3 months' . PHP_EOL . 'We will add 2014-04-01 as end date' . PHP_EOL;
    echo 'Optionally you can search for specific date like 2014-02-01' . PHP_EOL;
    $options['e'] = '2014-04-01';
}


$t_months = new DateInterval('P3M');
foreach ($data as $key => $value) {
    $sale_date = new DateTime($value['SaleDate']);
    $end_date = new DateTime($options['e']);
    $sale_date->add($t_months);
    $difference = $sale_date->diff($end_date);
    if ($difference->m < 3 && $difference->y == 0) {
        $BestSellingModelDate[$value['SaleDate']][$value['BuyerID']][$value['ModelID']] += 1;//incase we need to get for proper date
        ksort($BestSellingModelDate);
        arsort($BestSellingModelDate[$value['SaleDate']][$value['BuyerID']]);
        $BestSellingModel[$value['BuyerID']][$value['ModelID']] += 1;
        arsort($BestSellingModel[$value['BuyerID']]);
    }


}
if (!isset($options['s'])) {
    foreach ($BestSellingModel as $key => $value) {
        foreach (array_keys($BestSellingModel[$key], max($BestSellingModel[$key])) as $bestValue) {
            $bestModel = $bestValue;
            $bestModelForAll[$bestModel] += 1;
        }
    }
    echo 'Best selling model is: ' . implode(',',array_keys($bestModelForAll, max($bestModelForAll))) . PHP_EOL;
} else {
    foreach ($BestSellingModelDate as $key => $value) {
        if ($key == $options['s']) {
            $tempSellingModelDate[$key] = $value;
            foreach ($value as $subkey => $subvalue) {
                foreach (array_keys($value[$subkey], max($value[$subkey])) as $bestValue) {
                    $bestModel = $bestValue;
                    $bestModelForAll[$bestModel] += 1;
                }
            }
        }
    }
    if (isset($bestModelForAll)) //for all clients getting the best max (if they were same number of max will show them all)
        echo 'Best selling model for date [' . $options['s'] . '] is: ' . implode(',', array_keys($bestModelForAll, max($bestModelForAll))) . PHP_EOL;
    else
        echo 'Not Found records for specific date: ' . $options['s'] . PHP_EOL;
}


?>