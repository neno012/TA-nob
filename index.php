<?php

// $data = [
//     ['time'=>'08:00', 'current'=>82],
//     ['time'=>'08:05', 'current'=>95],
//     ['time'=>'08:10', 'current'=>104],
//     ['time'=>'08:15', 'current'=>112],
//     ['time'=>'08:20', 'current'=>118],
//     ['time'=>'08:25', 'current'=>123],
//     ['time'=>'08:30', 'current'=>127],
//     ['time'=>'08:35', 'current'=>131],
//     ['time'=>'08:40', 'current'=>135],
//     ['time'=>'08:45', 'current'=>138],
//     ['time'=>'08:50', 'current'=>142],
//     ['time'=>'08:55', 'current'=>145],
//     ['time'=>'09:00', 'current'=>148],
//     ['time'=>'09:05', 'current'=>152],
//     ['time'=>'09:10', 'current'=>149],
//     ['time'=>'09:15', 'current'=>143],
//     ['time'=>'09:20', 'current'=>137],
//     ['time'=>'09:25', 'current'=>128],
//     ['time'=>'09:30', 'current'=>120],
//     ['time'=>'09:35', 'current'=>110]
// ];

// $labels = [];
// $currents = [];

// foreach($data as $row){
//     $labels[] = $row['time'];
//     $currents[] = $row['current'];
// }

// $current = end($currents);

// function triangular($x, $a, $b, $c)
// {
//     if ($x <= $a || $x >= $c) return 0;
//     if ($x == $b) return 1;

//     if ($x < $b)
//         return ($x - $a) / ($b - $a);

//     return ($c - $x) / ($c - $b);
// }

// function trapezoidal($x, $a, $b, $c, $d)
// {
//     if ($x <= $a) return 0;
//     if ($x >= $d) return 1;

//     if ($x >= $b && $x <= $c)
//         return 1;

//     if ($x > $a && $x < $b)
//         return ($x - $a) / ($b - $a);

//     return ($d - $x) / ($d - $c);
// }

// $normal   = triangular($current, 60, 90, 120);
// $warning  = triangular($current, 110, 130, 145);
// $overload = trapezoidal($current, 140, 150, 180, 180);

// $membership = [
//     'NORMAL'=>$normal,
//     'WARNING'=>$warning,
//     'OVERLOAD'=>$overload
// ];

// arsort($membership);

// $status = array_key_first($membership);

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<title>Monitoring MCCB 150A</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="container mt-4">

<h2>Monitoring MCCB 150A</h2>

<div class="alert alert-info">
    Current Terakhir :
    <strong></strong>
    |
    Status :
    <strong></strong>
</div>

<div class="row">

    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                Trend Arus 20 Data Terakhir
            </div>

            <div class="card-body">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card">
            <div class="card-header">
                Membership Fuzzy
            </div>

            <div class="card-body">
                <canvas id="fuzzyChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script>

// =========================
// TREND CURRENT
// =========================

// new Chart(document.getElementById('trendChart'), {

//     type: 'line',

//     data: {

//         labels: <?= json_encode($labels) ?>,

//         datasets: [

//             {
//                 label: 'Current (A)',
//                 data: <?= json_encode($currents) ?>,
//                 tension: 0.3
//             },

//             {
//                 label: 'Warning',
//                 data: Array(<?= count($currents) ?>).fill(130),
//                 borderDash: [5,5],
//                 pointRadius: 0
//             },

//             {
//                 label: 'Overload',
//                 data: Array(<?= count($currents) ?>).fill(150),
//                 borderDash: [10,5],
//                 pointRadius: 0
//             }

//         ]
//     },

//     options: {

//         responsive: true,

//         scales: {

//             y: {
//                 beginAtZero: true,
//                 max: 180
//             }

//         }

//     }

// });

// =========================
// FUZZY MEMBERSHIP
// =========================

// new Chart(document.getElementById('fuzzyChart'), {

//     type: 'bar',

//     data: {

//         labels: [
//             'Normal',
//             'Warning',
//             'Overload'
//         ],

//         datasets: [{

//             label: 'Membership',

//             data: [
//                 <?= round($normal,3) ?>,
//                 <?= round($warning,3) ?>,
//                 <?= round($overload,3) ?>
//             ]

//         }]

//     },

//     options: {

//         scales: {

//             y: {
//                 beginAtZero: true,
//                 max: 1
//             }

//         }

//     }

// });

</script>

</body>
</html>