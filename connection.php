<?php
    $conn = mysqli_connect('localhost','root','','logophile');
    if(!$conn){
        echo "Connection Failed! ".mysqli_connect_error($conn);
    }
?>