<?php

define('PROJECT_PATH', dirname(__DIR__));

require_once PROJECT_PATH . '/vendor/autoload.php';

require_once PROJECT_PATH . '/bootstrap/paths.php';

$application = require_once PROJECT_PATH . '/bootstrap/app.php';
$application->run();


//$amount = 130;
//
//$content = [
//    'message' => 'failed'
//];
//
//$possibleMoneys = [
//    100, 50, 20, 10
//];
//
//$totalResult = [
//    '100' => 0,
//    '50' => 0,
//    '20' => 0,
//    '10' => 0
//];
//
//$result = giveMeBiggestPossible($amount, $possibleMoneys, $totalResult);
//
//$totalResult = array_filter($totalResult, function($v, $k) {
//    return $v !== 0;
//}, ARRAY_FILTER_USE_BOTH);
//
//if ($result === 0) {
//    $content['message'] = 'success';
//    $content['result'] = $totalResult;
//}
//
//var_dump($content);
//
//function giveMeBiggestPossible(int $amount, array $dividers, &$totalResult)
//{
//    while ($amount / $dividers[0] >= 1) {
//        $amount -= $dividers[0];
//        $totalResult[$dividers[0]] += 1;
//    }
//
//    if (sizeof($dividers) > 1) {
//        $amount = giveMeBiggestPossible($amount, array_slice($dividers, 1), $totalResult);
//    }
//
//    return $amount;
//}