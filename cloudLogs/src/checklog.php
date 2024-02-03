<?php
include('db.php');
$sqlread = "SELECT * FROM checkLog";
$result = $conn->query($sqlread);
// if (!$result) {
//     printf("Error: %s\n", mysqli_error($conn));
//     exit();
// }
while($row = mysqli_fetch_array($result)){
$msg = $row['msg'];
$response = $row['response'];
$_date = $row['_date'];
$_time = $row['_time'];

echo $msg . " - " . $response . " - (". $_date ." - " . $_time .")" . "<br>";
}
