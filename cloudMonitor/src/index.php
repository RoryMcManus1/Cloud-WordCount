<?php
include('functions.php');
include('db.php');


$frontURL = 'http://frontend.40132363.qpc.hal.davecutting.uk/';
$checkURL = 'http://check.40132363.qpc.hal.davecutting.uk/';
$countURL = 'http://wordcount.40132363.qpc.hal.davecutting.uk/';
$freqURL =  'http://freq.40132363.qpc.hal.davecutting.uk/';

$frontdomain = 'frontend.40132363.qpc.hal.davecutting.uk';
$checkdomain = 'check.40132363.qpc.hal.davecutting.uk';
$freqdomain = 'freq.40132363.qpc.hal.davecutting.uk';
$countdomain = 'wordcount.40132363.qpc.hal.davecutting.uk';
$totalNodes = 4;
$nodesonline = 0;
$nodesoffline = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <h2 class="title">Nodes</h2>
    <div class="small_container">
        <div class="row">
            <div class="col-3">
                <a href="http://frontend.40132363.qpc.hal.davecutting.uk/"></a>
                <?php
                if (!urlcheck($frontURL)) {
                  //--------------------------IF OFFLINE ----------------------------
                    echo "<h3>Frontend <img src='offline.jpg' width='30px' height='30px'</a></h3>" . "";
                    echo "Frontend is down!";
                    echo "<br>";
                    echo "Email Sent!";
                    emailAlert($frontURL);
                    $nodesoffline++;
                    echo "<br>";
                    $msg = "Frontend is DOWN!";
                    $_date = date('l jS \of F Y');
                    $_time = date('h:i:s A');
                    $response =" ";
                    frontLog($conn, $msg, $response, $_date,$_time);
                } else {
                    //--------------------------IF ONLINE ----------------------------
                    echo "<h3>Frontend <img src='online.jpg' width='30px' height='30px'</a></h3>" . "";
                    echo "Frontend is available.";
                    echo "<br>";
                    echo 'HTTP response: ';
                    $nodesonline++;
                    echo ping($frontdomain);
                    echo "ms";
                    //--------------------------ABOVE THRESHOLD ----------------------------
                    if (ping($frontdomain) > 100) {
                        $msg = "Frontend response time EXCEEDED threshold.";
                        $_date = date('l jS \of F Y');
                        $_time = date('h:i:s A');
                        $response =ping($frontdomain). "ms";
                        frontLog($conn, $msg, $response, $_date,$_time);
                    } else {
                        //--------------------------BELOW THRESHOLD ----------------------------
                        $msg = "Frontend response time BELOW threshold.";
                        $_date = date('l jS \of F Y');
                        $_time = date('h:i:s A');
                        $response =ping($frontdomain). "ms";
                        frontLog($conn, $msg, $response, $_date,$_time);
                    }
                }  echo "<br>";
                  echo "<a href='http://logs.40132363.qpc.hal.davecutting.uk/frontlog.php'>View Logs</a>";
                echo "<br>";
                ?>
            </div>
            <div class="col-3">
                <?php
                if (!urlcheck($checkURL)) {
                    //--------------------------IF OFFLINE ----------------------------
                    echo "<h3>Check <img src='offline.jpg' width='30px' height='30px'</a></h3>" . "";
                    echo "Check is down!";
                    echo "<br>";
                    echo "Email Sent!";
                    emailAlert($checkURL);
                    $nodesoffline++;
                    $msg = "Check is DOWN!";
                    $_date = date('l jS \of F Y');
                    $_time = date('h:i:s A');
                    $response =" ";
                    checkLog($conn, $msg, $response, $_date,$_time);
                } else {
                    //--------------------------IF ONLINE ----------------------------
                    echo "<h3>Check <img src='online.jpg' width='30px' height='30px'</a></h3>" . "";
                    echo "Check is available.";
                    echo "<br>";
                    echo 'HTTP response: ';
                    echo ping($checkdomain);
                    echo "ms";
                    $nodesonline++;
                    if (ping($checkdomain) > 100) {
                        //--------------------------ABOVE THRESHOLD ----------------------------
                        $msg = "Check response time ABOVE threshold.";
                        $_date = date('l jS \of F Y');
                        $_time = date('h:i:s A');
                        $response =ping($frontdomain). "ms";
                        checkLog($conn, $msg, $response, $_date,$_time);
                    } else {
                        //--------------------------BELOW THRESHOLD ----------------------------
                        $msg = "Check response time BELOW threshold.";
                        $_date = date('l jS \of F Y');
                        $_time = date('h:i:s A');
                        $response =ping($checkdomain). "ms";
                        checkLog($conn, $msg, $response, $_date,$_time);
                    }
                }  echo "<br>";
                echo "<a href='http://logs.40132363.qpc.hal.davecutting.uk/checklog.php'>View Logs</a>";
                echo "<br>";
                ?>
            </div>
            <div class="col-3">
                <?php
                if (!urlcheck($freqURL)) {
                    echo "<h3>Frequency <img src='offline.jpg' width='30px' height='30px'</a></h3>" . "";
                    echo "Frequency is down!";
                    echo "<br>";
                    echo "Email Sent!";
                    emailAlert($freqURL);
                    $nodesoffline++;
                    $msg = "Frequency is DOWN!";
                    $_date = date('l jS \of F Y');
                    $_time = date('h:i:s A');
                    $response =" ";
                    freqLog($conn, $msg, $response, $_date,$_time);
                } else {
                    echo "<h3>Frequency <img src='online.jpg' width='30px' height='30px'</a></h3>" . "";
                    echo "Frequency is available.";
                    echo "<br>";
                    echo 'HTTP response: ';
                    echo ping($freqdomain);
                    echo "ms";
                    $nodesonline++;
                    if (ping($freqdomain) > 100) {
                      $msg = "Frequency response time ABOVE threshold.";
                      $_date = date('l jS \of F Y');
                      $_time = date('h:i:s A');
                      $response =ping($freqdomain). "ms";
                      freqLog($conn, $msg, $response, $_date,$_time);
                    } else {
                      $msg = "Frequency response time BELOW threshold.";
                      $_date = date('l jS \of F Y');
                      $_time = date('h:i:s A');
                      $response =ping($freqdomain). "ms";
                      freqLog($conn, $msg, $response, $_date,$_time);
                    }
                }  echo "<br>";
                echo "<a href='http://logs.40132363.qpc.hal.davecutting.uk/freqlog.php'>View Logs</a>";
  echo "<br>";

                ?>
            </div>
            <div class="row">
                <div class="col-3">
                    <?php
                    if (!urlcheck($countURL)) {
                        echo "<h3>Count <img src='offline.jpg' width='30px' height='30px'</a></h3>" . "";
                        echo "Count is down!";
                        echo "<br>";
                        echo "Email Sent!";
                        emailAlert($countURL);
                        $nodesoffline++;
                        $msg = "Count is DOWN!";
                        $_date = date('l jS \of F Y');
                        $_time = date('h:i:s A');
                        $response =" ";
                        countLog($conn, $msg, $response, $_date,$_time);
                    } else {
                        echo "<h3>Count <img src='online.jpg' width='30px' height='30px'</a></h3>" . "";
                        echo "Count is available.";
                        echo "<br>";
                        echo 'HTTP response: ';
                        echo ping($countdomain);
                        echo "ms";
                        $nodesonline++;
                        if (ping($countdomain) > 100) {
                          $msg = "Count response time ABOVE threshold.";
                          $_date = date('l jS \of F Y');
                          $_time = date('h:i:s A');
                          $response =ping($countdomain). "ms";
                          countLog($conn, $msg, $response, $_date,$_time);
                        } else {
                          $msg = "Count response time ABOVE threshold.";
                          $_date = date('l jS \of F Y');
                          $_time = date('h:i:s A');
                          $response =ping($countdomain). "ms";
                          countLog($conn, $msg, $response, $_date,$_time);
                        }
                    }  echo "<br>";
                    echo "<a href='http://logs.40132363.qpc.hal.davecutting.uk/countlog.php'>View Logs</a>";
                    echo "<br>";
                    ?>
                </div>
            </div>
        </div>
        <h2 class="title">Stats</h2>
        <div class="row">
            <?php
            echo "Total Nodes: " . $totalNodes;
            echo "<br>";
            echo "Nodes Online: " . $nodesonline;
            echo "<br>";
            echo "Nodes Offline: " . $nodesoffline;
            echo "<br>";
            $nodesOnlinepercentage = $nodesonline / $totalNodes * 100;
            echo "Nodes Online percentage Online: " . $nodesOnlinepercentage . "%";
            ?>
        </div>
</body>
<style type="text/css">
    .row {
        justify-content: space-around;
    }
    .col-2 {
        min-width: 300px;
        padding-top: 50px;
    }
    .col-3 {
        flex-basis: 30%;
        min-width: 250px;
        margin-bottom: 30px;
    }
    .small_container {
        max-width: 1080px;
        margin: auto;
        padding-left: 25px;
        padding-right: 25px;
        padding-bottom: 50px;
    }
    .title {
        text-align: center;
        margin: 0 auto 40px;
        position: relative;
        line-height: 60px;
        color: #555;
    }
