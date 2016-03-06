<?php

$data1 = [
    'labels' => [],
    'datasets' => [],
];
$data2 = [
    'labels' => [],
    'datasets' => [],
];
$data3 = [
    'labels' => [],
    'datasets' => [
        0 => [],
        1 => [],
    ],
];
$data4 = [
    'labels' => [],
    'datasets' => [
        0 => [],
        1 => [],
    ],
];
$data5 = [
    'labels' => [],
    'datasets' => [
        0 => [],
        1 => [],
    ],
];
$now = new \DateTime();
$sum1 = 10 * 30;
$sum2 = 50 * 30;
$sum3 = 4000;
foreach (range(1, 30) as $day){
    $sum1 = $sum1 - mt_rand(1, 10);
    $sum2 = $sum2 - mt_rand(20, 60);
    $sum3 = $sum3 - mt_rand(200, 400);
    $sum3_1 = $sum3 + mt_rand(13000, 20000); //First time buyer
    $sum3_2 = $sum3 + mt_rand(10000, 15000); //current users
    $sum4_1 = mt_rand(4800, 6000); //First time buyer
    $sum4_2 = mt_rand(2500, 3500); //current users
    $d = new \DateTime();
    $d->modify("-{$day} day");
    array_unshift($data1['labels'], $d->format('Y-m-d'));
    array_unshift($data1['datasets'], $sum1);
    array_unshift($data2['labels'], $d->format('Y-m-d'));
    array_unshift($data2['datasets'], $sum2);
    array_unshift($data3['labels'], $d->format('Y-m-d'));
    array_unshift($data3['datasets'][0], $sum3_1);
    array_unshift($data3['datasets'][1], $sum3_2);
    array_unshift($data4['labels'], $d->format('Y-m-d'));
    array_unshift($data4['datasets'][0], $sum4_1);
    array_unshift($data4['datasets'][1], $sum4_2);
}
$sum5_1 = 0;
$sum5_2 = 0;
foreach (range(0, 24) as $hour) {
    $peak_hour_ratio = in_array($hour, [1, 2, 18, 19, 20, 21, 22, 23, 24]) ? 2.3 : 1.0;
    $sum5_1 = $sum5_1 + mt_rand(10000, 15000) * $peak_hour_ratio;
    $sum5_2 = $sum5_2 + mt_rand(10000, 15000) * $peak_hour_ratio * 1.02;
    array_push($data5['labels'], $hour . '時');
    array_push($data5['datasets'][0], $sum5_1);
    if ($now->format('i') >= $hour) {
        array_push($data5['datasets'][1], $sum5_2);
    }

}
$data = [];
$data[] = $data1;
$data[] = $data2;
$data[] = $data3;
$data[] = $data4;
$data[] = $data5;

//header("Content-Type: text/javascript; charset=utf-8"); //for debug
header("Content-Type: application/json; charset=utf-8");
echo json_encode($data);