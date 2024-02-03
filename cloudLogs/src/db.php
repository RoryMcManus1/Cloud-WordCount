<?php
   $passw = "F7PGXfhkP5s1Zgrw";

   $username1 = "rmcmanus07";

   $db = "rmcmanus07";

   $host = "rmcmanus07.lampt.eeecs.qub.ac.uk";


    $conn = new mysqli($host, $username1, $passw, $db);

    if($conn->connect_error){
        echo "not connected".$conn->connect_error;
    }else{
        //echo "connection to DB found.";
    }

?>
