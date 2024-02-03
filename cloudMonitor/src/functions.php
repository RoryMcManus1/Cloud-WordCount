<?php
include('db.php');
function urlcheck($url)
{
    $timeout = 10;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $http_respond = curl_exec($ch);
    $http_respond = trim(strip_tags($http_respond));
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (($http_code == "200") || ($http_code == "302")) {
        return true;
    } else {
        return false;
    }
    curl_close($ch);
}

function ping($domain)
{
    $starttime = microtime(true);
    // supress error messages with @
    $file      = @fsockopen($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) {
        $status = -1;  // Site is down
    } else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}
function emailAlert($url)
{
    require_once('mailer/PHPMailerAutoload.php');
    $url;
    $monitoringUrl = 'http://monitor.40132363.qpc.hal.davecutting.uk/';
    $mail =  new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = "cloudservicefail@gmail.com";
    $mail->Password = "40132363";
    $mail->SetFrom("cloudservicefail@gmail.com");
    $mail->Subject = 'Cloud Service Failure';
    $mail->Body = $url . '  is down go and check!!! :'   . $monitoringUrl;
    $mail->addAddress("cloudservicefail@gmail.com");

    $mail->send();
}
function frontLog($conn, $msg, $response, $_date,$_time){
    $sql = "INSERT INTO frontLog (msg,response,_date,_time) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "fail!!";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $msg, $response, $_date,$_time);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

}
function checkLog($conn, $msg, $response, $_date,$_time){
    $sql = "INSERT INTO checkLog (msg,response,_date,_time) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "fail!!";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $msg, $response, $_date,$_time);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

}

function freqLog($conn, $msg, $response, $_date,$_time){
    $sql = "INSERT INTO freqLog (msg,response,_date,_time) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $msg, $response, $_date,$_time);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

}
function countLog($conn, $msg, $response, $_date,$_time){
    $sql = "INSERT INTO countLog (msg,response,_date,_time) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "fail!!";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $msg, $response, $_date,$_time);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

}
