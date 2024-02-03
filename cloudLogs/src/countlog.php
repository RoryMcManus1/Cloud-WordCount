<?php
include('db.php');
$sqlread = "SELECT * FROM countLog";
$result = $conn->query($sqlread);
// if (!$result) {
//     printf("Error: %s\n", mysqli_error($conn));
//     exit();
// }
while($row = mysqli_fetch_array($result)){
$msg = $row['msg'];

echo $msg;
}
