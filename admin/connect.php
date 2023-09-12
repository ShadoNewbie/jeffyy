<?php
$conn=mysqli_connect('localhost', 'root', "",'inventory');
if(!$conn){
    die(mysqli_error("Error"+$conn));
}

?>